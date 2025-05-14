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
        $user = Auth::user();
        $total = KritikSaran::where('user_id', Auth::id())->count();
        $baru = KritikSaran::where('user_id', Auth::id())->where('status', 'baru')->count();
        $proses = KritikSaran::where('user_id', Auth::id())->where('status', 'proses')->count();
        $selesai = KritikSaran::where('user_id', Auth::id())->where('status', 'selesai')->count();

        // Fetch the latest KritikSaran with its response (if any)
        $latestKritikSaran = KritikSaran::where('user_id', Auth::id())
                            ->with('tanggapan')
                            ->latest()
                            ->first();

        return view('user.dashboard', compact('user', 'total', 'baru', 'proses', 'selesai', 'latestKritikSaran'));
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
        $user = Auth::user();
        $baru = KritikSaran::where('user_id', Auth::id())->where('status', 'baru')->count();

        // Retrieve all available categories for dropdown
        $kategoris = Kategori::all();

        return view('user.pesan', compact('user', 'baru', 'kategoris'));
    }

    // Simpan pesan
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'     => 'required|string|max:255',
            'pesan'     => 'required|string',
            'lampiran'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kategori_id' => 'nullable|exists:kategoris,id',
        ]);

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('lampiran','public');
        }

        // Set additional fields
        $data['user_id'] = Auth::id();
        $data['status'] = 'baru';
        $data['tanggal_kirim'] = now();
        $data['prioritas'] = 1; // Default priority

        KritikSaran::create($data);

        return redirect()->route('user.riwayat')
                        ->with('success','Pesan berhasil dikirim');
    }

    // Riwayat pesan
    public function riwayat()
    {
        $user = Auth::user();
        $baru = KritikSaran::where('user_id', Auth::id())->where('status', 'baru')->count();
        $pesans = KritikSaran::where('user_id', Auth::id())
                             ->latest()
                             ->paginate(10);

        return view('user.riwayat', compact('user', 'baru', 'pesans'));
    }

    // Lihat detail pesan
    public function show($id)
    {
        $user = Auth::user();
        $baru = KritikSaran::where('user_id', Auth::id())->where('status', 'baru')->count();

        $pesan = KritikSaran::where('id', $id)
                           ->where('user_id', Auth::id())
                           ->with(['tanggapan', 'kategori'])
                           ->firstOrFail();

        return view('user.detail', compact('user', 'baru', 'pesan'));
    }


}
