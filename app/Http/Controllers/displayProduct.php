<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\User;


class displayProduct extends Controller
{
    public function dangky ()
    {
        return view('dangky');

    }
    public function getdangky (Request $request)
    {
        $email=$request->email;
        $password= md5 ($request->password);

        DB::table('users')->insert(['email'=>$email,'password'=>$password]);
        echo "đã thêm 1 thanh vien moi";
       
    }
    public function displayPd()
{
   $proDuct = DB::table('displaypd')->take(10)->get();
   return view('home', ['proDuct' => $proDuct]);
}

    public function getaddProduct (Request $request)
    {
        $name=$request->productName;
        $price= $request->productPrice;
        $image=$request->productImage;
        $description=$request->productDescription;

        DB::table('displaypd')->insert(['product_name'=>$name,'product_price'=>$price,'product_image'=>$image,'product_description'=>$description]);
        echo "đã thêm 1 sản phẩm moi";
        dd($request->all());
        return view('trangAdmin');
       
    }
    public function addProduct()
    {
        return view('addProduct');
    }
    public function trangchu ()
    {
       
       return view('home');

    }
    public function editsp($id)
{
    $product = Product::findOrFail($id);

    return view('editsp', ['product' => $product]);
}

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->product_name = $request->input('productName');
        $product->product_price = $request->input('productPrice');
        $product->product_image = $request->input('productImage');
        $product->product_description = $request->input('productDescription');
        $product->save();
    
        return redirect()->route('quanlysp')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    

    public function gioithieu()
    {
        return view('gioithieu');
    }
    public function ttLienhe()
    {
        return view('ttLienhe');
    }
    public function ttSanpham()
    {
        return view('ttSanpham');
    }
    public function trangAdmin()
    {
        return view('trangAdmin');
    }
    public function giohang()
    {
        return view('giohang');
    }
    
    public function home()
    {
        return view('home');
    }
    
    public function quanlysp()
    {

        $proDuct = DB::table('displaypd')->get();
        return view('quanlysp', ['proDuct' => $proDuct]);

    } public function thongke()
    {

        return view ('thongke');

    }
    public function Customer()
    {

        $Customer = DB::table('users')->get();
        return view('Customer', ['Customer' => $Customer]);

    }
    public function qldonhang()
    {
        return view('qldonhang');
    }
    public function delete($id)
    {
        // Tìm sản phẩm cần xóa
        $product = Product::findOrFail($id);
    
        // Xóa sản phẩm
        $product->delete();
    
        // Chuyển hướng hoặc trả về dữ liệu JSON hoặc hiển thị thông báo thành công tùy theo yêu cầu của bạn
        // Ví dụ: chuyển hướng về trang danh sách sản phẩm
        return redirect()->route('quanlysp')->with('success', 'Xóa sản phẩm thành công');
    }
    public function deleteuser($id)
    {
        // Tìm sản phẩm cần xóa
        $user = User::findOrFail($id);
    
        // Xóa sản phẩm
        $user->delete();
    
        // Chuyển hướng hoặc trả về dữ liệu JSON hoặc hiển thị thông báo thành công tùy theo yêu cầu của bạn
        // Ví dụ: chuyển hướng về trang danh sách sản phẩm
        return redirect()->route('Customer')->with('success', 'Xóa sản phẩm thành công');
    }
    public function getRegister(Request $request)
    {
        // Validate dữ liệu được gửi từ form đăng ký
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        // Tạo một người dùng mới
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
    
        // Chuyển hướng người dùng sau khi đăng ký thành công
        return redirect()->route('login')->with('success', 'Đăng ký thành công!');
    }
    public function Register()
    {   
        return view('dangKy');
    }
    public function show($id)
    {   
        $product = Product::findOrFail($id);
        session()->put('product_id', $product->id);
    
        // Gọi hàm quanlysp để lấy dữ liệu sản phẩm
        $proDuct = DB::table('displaypd')
        ->orderByDesc('id')
        ->take(10)
        ->get();

    
        // Trả về view description với dữ liệu sản phẩm và sản phẩm cụ thể
        return view('description', compact('product', 'proDuct'));
    }
    
    
    public function test()
    {   
        return view('test');
    }

}
