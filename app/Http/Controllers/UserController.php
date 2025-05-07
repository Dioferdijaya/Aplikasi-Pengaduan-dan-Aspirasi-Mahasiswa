<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Dashboard mahasiswa
    public function dashboard()
    {
        $total   = KritikSaran::where('user_id', Auth::id())->count();
        $baru    = KritikSaran::where('user_id', Auth::id())->where('status', 'baru')->count();
        $proses  = KritikSaran::where('user_id', Auth::id())->where('status', 'proses')->count();
        $selesai = KritikSaran::where('user_id', Auth::id())->where('status', 'selesai')->count();

        return view('user.dashboard', compact('total','baru','proses','selesai'));
    }

    public function dataUser(): array
    {
        // Jika belum login, kembalikan kosong / default
        if (! Auth::check()) {
            return [
                'user' => null,
                'baru' => 0,
            ];
        }

        $user = Auth::user();

        // Hitung pesan dengan status 'baru' untuk user ini
        $baru = KritikSaran::where('user_id', $user->id)
                           ->where('status', 'baru')
                           ->count();

        return [
            'user' => $user,
            'baru' => $baru,
        ];
    }

    // Form kirim pesan
    public function create()
    {
        return view('user.pesan');
    }

    // Simpan pesan
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'pesan'     => 'required|string',
            'lampiran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('lampiran','public');
        }

        $data['user_id'] = Auth::id();
        $data['status']  = 'baru';

        KritikSaran::create($data);

        return redirect()->route('user.riwayat')
                         ->with('success','Pesan berhasil dikirim');
    }

    // Riwayat pesan
    public function riwayat()
    {
        $pesans = KritikSaran::where('user_id', Auth::id())
                              ->latest()
                              ->paginate(10);

        return view('user.riwayat', compact('pesans'));
    }
}
