<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login dan email belum diverifikasi
        if (Auth::check() && Auth::user()->email_verified_at === null) {
            // Jika request ajax, kirim response error
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Email belum diverifikasi.'], 403);
            }

            // Redirect ke halaman verifikasi dengan pesan
            return redirect()->route('verification.notice', ['email' => Auth::user()->email])
                ->with('warning', 'Anda harus memverifikasi email terlebih dahulu.');
        }

        return $next($request);
    }
}
