<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
   public function login ()
   {
     return view('login');
   }

   public function loadLogin(Request $request)
{
    // Kiểm tra xem người dùng đã nhập thông tin đăng nhập chưa
    $credentials = $request->only('email', 'password');

    // Thử đăng nhập với thông tin đã nhập
    if (Auth::attempt($credentials)) {
        // Nếu đăng nhập thành công, chuyển hướng đến trang chính
        return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
    } else {
        // Nếu đăng nhập không thành công, chuyển hướng người dùng trở lại trang đăng nhập với thông báo lỗi
        return redirect()->back()->withInput()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác']);
    }
}
}


