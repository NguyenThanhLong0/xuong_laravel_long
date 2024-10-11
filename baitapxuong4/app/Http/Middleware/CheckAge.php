<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $age = $request->input('age', 0);

        if ($age < 18) {
            // Chuyển hướng về trang chủ với thông báo nếu tuổi dưới 18
            return redirect('/')->with('error', 'Bạn chưa đủ 18 tuổi để truy cập trang này.');
        }

        // Cho phép tiếp tục nếu trên 18 tuổi
        return $next($request);
    }
}
