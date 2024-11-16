<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMultipleRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$roles): Response
    {
        // Ambil nilai userRole dari session
        $userRole = $request->session()->get('userRole');

        // Cek apakah userRole ada dan memiliki salah satu dari roles yang diperlukan
        if ($userRole && ($userRole == $roles)) {
            return $next($request);
        }

        // Jika tidak memiliki hak akses, mungkin hendaknya redirect atau berikan pesan error
        $request->session()->forget('idUser');
        $request->session()->forget('username');
        $request->session()->forget('userRole');
        $request->session()->forget('namaUser');
        $request->session()->flash('errorLogin',"Akun anda tidap dapat mengakses halaman ini. Pastikan Login dengan akun yang benar!");
        return redirect('/');
        // return response()->json(['error' => 'Unauthorized'], 403);
        // return $next($request);
    }
    
}
