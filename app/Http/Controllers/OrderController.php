<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

use App\Models\Order; // Import model Order

class OrderController extends Controller
{
 

    public function payment_COD(Request $request)
    {
        // Xử lý dữ liệu được gửi từ form
        $ten = $request->input('ten');
       
        $dia_chi = $request->input('dia_chi');
        $so_dien_thoai = $request->input('so_dien_thoai');
        $email = $request->input('email');
        
        $phuong_thuc_thanh_toan = $request->input('phuong_thuc_thanh_toan');
        $total_payment = $request->input('total_payment');

        // Tiến hành lưu dữ liệu vào cơ sở dữ liệu
        $order = new Order();
        $order->ten = $ten;
    
        $order->dia_chi = $dia_chi;
        $order->so_dien_thoai = $so_dien_thoai;
        $order->email = $email;
        $order->phuong_thuc_thanh_toan	 = $phuong_thuc_thanh_toan;
        $order->tong_thanh_toan	 = $total_payment;
        $order->save();

        // Điều hướng sau khi xử lý thành công, bạn có thể thay đổi điều này tùy theo nhu cầu của bạn
        return redirect()->route('payment_COD')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }
    public function thanhtoan()
    {
        $Carts = Cart::all(); // hoặc lấy dữ liệu từ model hoặc từ bất kỳ nguồn dữ liệu nào khác
        return view('payment_cod', ['Carts' => $Carts]);
    }
}
