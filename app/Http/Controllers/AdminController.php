<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\KritikSaran;
use App\Models\Tanggapan;

class AdminController extends Controller
{
    // Dashboard admin
    public function dashboard()
    {
        $total   = KritikSaran::count();
        $baru    = KritikSaran::where('status','baru')->count();
        $proses  = KritikSaran::where('status','proses')->count();
        $selesai = KritikSaran::where('status','selesai')->count();

        return view('admin.dashboard', compact('total','baru','proses','selesai'));
    }

    // Form balas pesan
    public function showBalas($id)
    {
        $pesan = KritikSaran::findOrFail($id);
        return view('admin.balas', compact('pesan'));
    }

    // Simpan tanggapan
    public function storeBalas(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pesan = KritikSaran::findOrFail($id);

        Tanggapan::create([
            'kritik_saran_id' => $pesan->id,
            'admin_id'        => Auth::id(),
            'isi_tanggapan'   => $request->tanggapan,
            'tanggal'         => now(),
        ]);

        // Update status pesan
        $pesan->update(['status' => 'proses']);

        return redirect()->route('admin.riwayat')
                         ->with('success','Tanggapan berhasil dikirim');
    }

    // Riwayat semua pesan & tanggapan
    public function riwayat()
    {
        $pesans = KritikSaran::with('tanggapan')
                             ->latest()
                             ->paginate(10);

        return view('admin.riwayat', compact('pesans'));
    }
}
