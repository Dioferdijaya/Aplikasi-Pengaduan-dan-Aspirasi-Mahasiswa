<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    // Tampilan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses form registrasi
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'nama_lengkap' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    // Validasi domain email
                    $domain = explode('@', $value)[1] ?? '';
                    if (!in_array($domain, ['mhs.usk.ac.id', 'usk.ac.id'])) {
                        $fail('Email harus menggunakan domain @mhs.usk.ac.id atau @usk.ac.id.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // 1. Ambil domain e-mail
        $email  = $request->email;
        $domain = explode('@', $email)[1] ?? '';

        // 2. Tentukan role: mhs.usk.ac.id → user, lainnya (usk.ac.id) → admin
        $role = $domain === 'mhs.usk.ac.id' ? 'user' : 'admin';

        // Simpan data pengguna sementara di session
        $request->session()->put('registration_data', [
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telepon' => $request->no_telepon,
            'role'         => $role,
        ]);

        // Kirim OTP ke email
        $this->otpService->sendOtp($request->email);

        // Redirect ke halaman verifikasi OTP
        return redirect()->route('verification.notice', ['email' => $request->email]);
    }

    // Tampilkan form verifikasi OTP
    public function showVerificationForm(Request $request)
    {
        $email = $request->query('email');
        return view('auth.verify', compact('email'));
    }

    // Proses verifikasi OTP
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp_code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verifikasi OTP
        $verified = $this->otpService->verifyOtp($request->email, $request->otp_code);

        if (!$verified) {
            return redirect()->back()
                ->withErrors(['otp_code' => 'Kode OTP tidak valid atau sudah kedaluwarsa.'])
                ->withInput();
        }

        // Ambil data registrasi dari session
        $registrationData = $request->session()->get('registration_data');


        // Buat user baru
        $user = User::create([
            'username' => $registrationData['username'],
            'nama_lengkap' => $registrationData['nama_lengkap'],
            'email' => $registrationData['email'],
            'password' => $registrationData['password'],
            'no_telepon' => $registrationData['no_telepon'],
            'role' => $registrationData['role'],
            'email_verified_at' => now(),
        ]);

        // Hapus data session
        $request->session()->forget('registration_data');

        // Login user baru
        Auth::login($user);

        // Redirect ke dashboard user setelah berhasil mendaftar
        return redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil!');
    }

    // Kirim ulang OTP
    public function resendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Kirim OTP baru
        $this->otpService->sendOtp($request->email);

        return redirect()->back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
