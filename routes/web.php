<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\displayProduct; // Import controller displayProductController
use Inertia\Inertia;
use App\Http\Middleware\Dangnhap;
use App\Http\Controllers\login;
use App\Http\Controllers\Carts;
use App\Http\Controllers\OrderController;


use App\Http\Middleware\ExampleMiddleware;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware(ExampleMiddleware::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard')->middleware(ExampleMiddleware::class); // Sử dụng middleware ExampleMiddleware cho route '/dashboard'
});

Route::get('/dangky', [displayProduct::class, 'Register']);
Route::post('/dangky', [displayProduct::class, 'Register'])->name('dangky');

Route::post('/getRegister', [displayProduct::class, 'getRegister'])->name('getRegister');

Route::get('/trangAdmin', [displayProduct::class, 'trangAdmin']); // Sử dụng controller displayProductController và phương thức trangchu
Route::get('/quanlysp', [displayProduct::class, 'quanlysp'])->name('quanlysp');
Route::get('/Customer', [displayProduct::class, 'Customer'])->name('Customer');
Route::get('/qldonhang', [displayProduct::class, 'qldonhang'])->name('qldonhang');

Route::get('/addProduct', [displayProduct::class, 'addProduct'])->name('addProduct');
Route::post('/addProduct', [displayProduct::class, 'addProduct'])->name('addProduct');

Route::get('/getaddProduct', [displayProduct::class, 'getaddProduct'])->name('getaddProduct');
Route::post('/getaddProduct', [displayProduct::class, 'getaddProduct'])->name('getaddProduct');

Route::get('/editsp/{id}', [displayProduct::class, 'editsp'])->name('editsp');

Route::get('/home', [displayProduct::class, 'displayPd'])->name('home');
Route::get('/login', [login::class, 'login'])->name('login');
Route::get('/loadLogin', [login::class, 'loadLogin'])->name('loadLogin');
Route::post('/loadLogin', [login::class, 'loadLogin'])->name('loadLogin');

Route::put('/updateProduct/{id}', [displayProduct::class, 'updateProduct'])->name('updateProduct');


Route::delete('/deleteProduct/{id}', [displayProduct::class, 'delete'])->name('deleteProduct');
Route::get('/deleteProduct/{id}', [displayProduct::class, 'delete'])->name('deleteProduct');


Route::delete('/deleteCarts/{id}', [Carts::class, 'deleteCarts'])->name('deleteCarts');


Route::get('/show/{id}', [displayProduct::class, 'show'])->name('show');
Route::get('/ttLienhe', [displayProduct::class, 'ttLienhe'])->name('ttLienhe');

Route::post('/addToCart/{productId}', [Carts::class, 'addToCart'])->name('addToCart');

Route::get('/showCarts', [Carts::class, 'showCarts'])->name('showCarts');



Route::delete('/deleteuser{id}', [displayProduct::class, 'deleteuser'])->name('deleteuser');
Route::get('/thongke', [displayProduct::class, 'thongke'])->name('thongke');
// Đường dẫn đến trang thanh toán
Route::get('/payment', [Carts::class, 'index'])->name('Payment');
Route::post('/payment', [Carts::class, 'index'])->name('Payment');


Route::post('/payment_momo',  [Carts::class, 'payment_momo'])->name('payUrl');
Route::get('/payment_momo',  [Carts::class, 'payment_momo'])->name('payUrl');

Route::get('/payment_COD',  [OrderController::class, 'thanhtoan'])->name('COD');
Route::post('/payment_COD',  [OrderController::class, 'thanhtoan'])->name('COD');

Route::get('/search',  [Carts::class, 'search'])->name('search');
Route::post('/search',  [Carts::class, 'search'])->name('search');

Route::get('/thanhtoan',  [OrderController::class, 'thanhtoan']);


