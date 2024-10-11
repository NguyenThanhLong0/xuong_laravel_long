<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user) {

            return redirect('/login')->with('error', 'Bạn cần đăng nhập để truy cập.');
        }


        if ($role === 'admin' && $user->role !== 'admin') {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        if ($role === 'employee' && !in_array($user->role, ['admin', 'employee'])) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        if ($role === 'customer' && $user->role !== 'customer') {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }


        return $next($request);
    }
}
