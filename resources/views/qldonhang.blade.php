<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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
            height: 100%;
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
        .display {
            padding-left: 220px;
            padding-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
        }
        .btn-view {
            background-color: #008CBA;
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

<div class="display">
    <h2>Danh sách đơn hàng</h2>
    <table>
    <thead>
        <tr>
           <th>Ảnh sản phẩm</th>
            <th>Mã đơn hàng</th>
            <th>Trạng thái</th>
            <th>Hình thức thanh toán</th>
            <th>Số lượng</th>
            <th>Tùy chọn</th>
        </tr>
    </thead>
    <tbody>
        <!-- Dữ liệu đơn hàng sẽ được đưa vào đây -->
        <tr>
            <td></td>
            <td>DH001</td>
            <td>
            <select class="status-dropdown" onchange="updateStatus('DH001', this.value)">
                    <option value="Xác nhận">Xác nhận</option>
                    <option value="Đã giao">Đã giao</option>
                    <option value="Thành công">Thành công</option>
                </select>
            </td>
            <td>Thanh toán khi nhận hàng</td>
            <td>3</td>
            <td>
               
                <button class="btn btn-view btn-view-detail">Xem chi tiết</button>
            </td>
        </tr>
        <tr>
           <td></td>
            <td>DH002</td>
            <td>
            <select class="status-dropdown" onchange="updateStatus('DH002', this.value)">
                    <option value="Xác nhận">Xác nhận</option>
                    <option value="Đã giao">Đã giao</option>
                    <option value="Thành công">Thành công</option>
                </select>
            </td>
            <td>Thanh toán MOMO</td>
            <td>1</td>
            <td>
                
                <button class="btn btn-view btn-view-detail">Xem chi tiết</button>
            </td>
        </tr>
        <!-- Thêm các dòng tương tự cho các đơn hàng khác -->
    </tbody>
</table>

<script>
    function updateStatus(orderCode, newStatus) {
        // Gửi yêu cầu cập nhật trạng thái đơn hàng lên máy chủ
        // Thay đổi trạng thái hiển thị trên giao diện sau khi cập nhật thành công
        console.log('Cập nhật trạng thái của đơn hàng ' + orderCode + ' thành ' + newStatus);
        // Sau khi cập nhật thành công, có thể làm mới lại trang hoặc thực hiện các hành động khác
    }
</script>

</div>

<script>
    // Xử lý khi nhấn nút xem chi tiết
    const viewDetailButtons = document.querySelectorAll('.btn-view-detail');
    viewDetailButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Thực hiện hành động khi nhấn xem chi tiết, ví dụ chuyển hướng đến trang chi tiết đơn hàng
            // window.location.href = 'link_to_order_detail_page';
            console.log('Xem chi tiết đơn hàng');
        });
    });

    // Xử lý khi nhấn nút xác nhận
    const confirmButtons = document.querySelectorAll('.btn-confirm');
    confirmButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Thực hiện hành động khi nhấn xác nhận, ví dụ cập nhật trạng thái đơn hàng
            console.log('Xác nhận đơn hàng');
        });
    });
</script>

</body>
</html>
