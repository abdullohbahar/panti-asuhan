<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDonasi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == 'admin-yayasan') {
            return redirect()->route('dashboard.admin.yayasan');
        }

        if (Auth::user()->role == 'pembina-yayasan') {
            return redirect()->route('dashboard.pembina.yayasan');
        }

        if (Auth::user()->role == 'ketua-yayasan') {
            return redirect()->route('dashboard.ketua.yayasan');
        }

        if (Auth::user()->role == 'bendahara-yayasan') {
            return redirect()->route('dashboard.bendahara.yayasan');
        }

        if (Auth::user()->role == 'admin-donasi') {
            return $next($request);
        }

        if (Auth::user()->role == 'sekretariat-yayasan') {
            return redirect()->route('dashboard.sekretariat.yayasan');
        }

        if (Auth::user()->role == 'ketua-LKSA') {
            return redirect()->route('dashboard.ketua.lksa');
        }

        if (Auth::user()->role == 'bendahara-LKSA') {
            return redirect()->route('dashboard.bendahara.lksa');
        }

        if (Auth::user()->role == 'sekretariat-LKSA') {
            return redirect()->route('dashboard.sekretariat.lksa');
        }
    }
}
