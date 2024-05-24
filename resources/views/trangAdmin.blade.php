<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .header {
            height: 50px;
            background-color: aquamarine;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }
        .header img {
            width: 130px;
            height: 40px;
            margin-right: auto;
        }
        .menu {
            background-color: #333;
            color: #fff;
            width: 200px;
            height: 1000px;
            float: left;
            padding-top: 20px;
        }
        .menu h1 {
            text-align: center;
        }
        .menu nav {
            text-align: center;
        }
        .menu-link {
            display: block;
            padding: 10px 0;
            color: #fff;
            text-decoration: none;
        }
        .menu-link:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<header class="header">
    <img src="http://giaythethao.giaodienwebmau.com/wp-content/uploads/2019/10/logo.png" alt="logo thương hiệu">
    <a href="{{route('home')}}" style="padding-right: 20px; padding-left: 20px;">Trang chủ</a>
    <a href="#" style="padding-right: 20px; padding-left: 20px;">Đăng xuất</a>
    <div>Xin chào Admin</div>
</header>

<div class="menu">
    <h1>Menu</h1>
    <nav>
        <a href="{{route('quanlysp')}}" class="menu-link">Quản Lý Sản Phẩm</a>
            
        <a href="{{route('qldonhang')}}" class="menu-link">Quản Lý Đơn Hàng</a>
        <a href="{{route('thongke')}}" class="menu-link">Thống kê doanh thu </a>
        <a href="{{route('Customer')}}" class="menu-link">Danh sách khách hàng </a>
    </nav>
</div>

</body>
</html>
