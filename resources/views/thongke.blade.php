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
                background-color: #FFD700;
            }
            .menu-link:hover {
                background-color: #555;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            tr:hover {
                background-color: #f5f5f5;
            }
            .btn {
                padding: 6px 12px;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                margin-right: 10px;
            }
            .btn-delete {
                background-color: #f44336;
                color: white;
            }
            .btn-add {
                background-color: #4CAF50;
                color: white;
            }
            .btn-edit {
                background-color: #FFD700;
                color: white;
            }
            .display
            {
                padding-right: 20px;
                text-align: right;
                padding-left: 210px;
            }
            .content
            {
                width:100%;
            }
            .h2
            {
                margin:auto;
                text-align: center;
            }
            .image
            {
                width:70px;
                height:70px;    
            }
            body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.summary {
    display: flex;
    justify-content: space-around;
    margin-bottom: 30px;
}

.summary-item {
    text-align: center;
}

.summary-item h2 {
    margin-bottom: 5px;
}

.chart-container {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
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
    <div class=content>
    <div class="menu">
        <h1>Menu</h1>
        <nav>
        <a href="{{route('quanlysp')}}" class="menu-link">Quản Lý Sản Phẩm</a>
        <a href="{{route('qldonhang')}}" class="menu-link">Quản Lý Đơn Hàng</a>
        <a href="{{route('thongke')}}" class="menu-link">Thống kê doanh thu </a>
        <a href="{{route('Customer')}}" class="menu-link">Danh sách khách hàng </a>
    </nav>
    </div>
    <div class="container">
    <h1>Thống kê doanh thu hàng tháng</h1>
    <div class="summary">
        <div class="summary-item">
            <h2>Tổng số đơn hàng</h2>
            <p id="totalOrders">-</p>
        </div>
        <div class="summary-item">
            <h2>Tổng doanh thu</h2>
            <p id="totalRevenue">-</p>
        </div>
    </div>
    <div class="chart-container">
        <canvas id="revenueChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="revenueChart"></canvas>

<script>
   

    // Dữ liệu mẫu cho thống kê doanh thu (hàng tháng)
    const thang = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
    // Thay đổi dữ liệu doanh thu mẫu bằng dữ liệu thực tế từ nguồn dữ liệu của bạn
    const duLieuDoanhThu = [4, 5, 3, 6, 5, 6, 7, 8, 9, 10,7,9];



    // Lấy phần tử canvas
    const ctx = document.getElementById('revenueChart').getContext('2d');

    // Tạo biểu đồ doanh thu
    const bieuDoDoanhThu = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: thang,
            datasets: [{
                label: 'Doanh thu',
                data: duLieuDoanhThu,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (USD)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Cập nhật dữ liệu tổng hợp
    const tongDonHang = 500; // Số đơn hàng mẫu
    const tongDoanhThu = duLieuDoanhThu.reduce((tong, giaTri) => tong + giaTri, 0);
    document.getElementById('totalOrders').textContent = tongDonHang;
    document.getElementById('totalRevenue').textContent = tongDoanhThu.toLocaleString('vi-VN', { style: 'currency', currency: 'USD' });
</script>
      
    </body>
    </html>
