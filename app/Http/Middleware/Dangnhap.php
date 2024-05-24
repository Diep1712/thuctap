<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Dangnhap
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
        // Chuyển hướng người dùng đến trang "trangAdmin"
        return redirect()->route('trangAdmin');
    }
}
