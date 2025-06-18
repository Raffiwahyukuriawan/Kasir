<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware {
    public function handle(Request $request, Closure $next, ...$roles): Response {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil role user, default ke 'kasir' jika null
        $userRole = Auth::user()->role ?? 'kasir';

        // Cek apakah role user sesuai dengan yang diizinkan
        if (!in_array($userRole, $roles)) {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
