<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Carts extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        // Validate the request data
        
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::guest()) {
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.'); // Chuyển hướng đến trang đăng nhập
        }
        
        // Lấy thông tin người dùng đang đăng nhập
        $user = Auth::user();
        $userId = $user->id;
        
        $quantity = $request->quantity;
        $productSize = $request->product_size;
        // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu hay không
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $productImage = $product->product_image;
        $productPrice = $product->product_price;
        // Tạo một đối tượng Cart và gán giá trị cho các trường
        $cart = new Cart();
        $cart->user_id = $userId;
        $cart->product_id = $productId;
        $cart->product_image = $productImage;  // Thêm trường ảnh sản phẩm vào đối tượng Cart
        $cart->product_price = $productPrice;
        $cart->product_size = $productSize; // Thêm trường giá sản phẩm vào đối tượng Cart
        $cart->quantity = $quantity;
        
        // Lưu đối tượng Cart vào cơ sở dữ liệu
        $cart->save();
        
        // Trả về thông báo thành công
        $Carts = Cart::all(); // hoặc lấy dữ liệu từ model hoặc từ bất kỳ nguồn dữ liệu nào khác
        return view('carts', ['Carts' => $Carts]);
    }
    
    public function showCarts()
{
   $Carts = Cart::all(); // hoặc lấy dữ liệu từ model hoặc từ bất kỳ nguồn dữ liệu nào khác
   return view('carts', ['Carts' => $Carts]);
}
public function index()
{
    // Lấy dữ liệu từ session
    $Carts = Cart::all(); // hoặc lấy dữ liệu từ model hoặc từ bất kỳ nguồn dữ liệu nào khác
   return view('Payment', ['Carts' => $Carts]);
}

public function checkout(Request $request)
{
    // Xử lý các thao tác thanh toán ở đây

    // Sau khi xử lý, bạn có thể xóa session hoặc làm gì đó khác

    // Chuyển hướng đến trang thành công hoặc trang cần thiết khác
    return redirect()->route('success');
}

public function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}
public function payment_momo(Request $request)
{
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo = "Thanh toán qua MoMo";
    $amount = 10000; // Lấy giá trị từ request, không cần $_POST
    $orderId = time() . "";
    $redirectUrl = "http://localhost:8081/ThuctapLARAVEL/webbanhang/public/payment_momo";
    $ipnUrl = "http://localhost:8081/ThuctapLARAVEL/webbanhang/public/payment_momo";
    $extraData = "";

    $requestId = time() . "";
    $requestType = "payWithATM";

    // Before signing HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    $data = [
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    ];

    $result = $this->execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true); // Decode JSON

    // Kiểm tra nếu mảng chứa khóa 'payUrl' trước khi truy cập
    if (isset($jsonResult['payUrl'])) {
        return redirect()->to($jsonResult['payUrl']);
    } else {
        // Xử lý trường hợp 'payUrl' không tồn tại
        return redirect()->back()->with('error', 'PayUrl not found');
    }
}




public function search(Request $request)
{
    // Lấy từ khóa tìm kiếm từ request
    $keyword = $request->keyword;

    // Tìm kiếm sản phẩm có tên chứa từ khóa
    $products = Product::where('product_name', 'like', "%$keyword%")->get();
    if ($products->isEmpty()) {
        // Nếu không có sản phẩm nào, trả về view với thông báo
        return view('search', ['message' => 'Không tìm thấy sản phẩm nào phù hợp với từ khóa tìm kiếm của bạn.']);
    }

    // Trả về view hiển thị kết quả tìm kiếm
    return view('search', ['products' => $products, 'keyword' => $keyword]);

}
public function deleteCarts($id)
    {
        // Tìm sản phẩm cần xóa
        $carts = Cart::findOrFail($id);
    
        // Xóa sản phẩm
        $carts->delete();
    
        // Chuyển hướng hoặc trả về dữ liệu JSON hoặc hiển thị thông báo thành công tùy theo yêu cầu của bạn
        // Ví dụ: chuyển hướng về trang danh sách sản phẩm
        return redirect()->route('showCarts')->with('success', 'Xóa sản phẩm thành công');
    }
}