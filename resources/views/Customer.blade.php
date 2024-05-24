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
    <div class=display>
        <h2>Thông tin sản phẩm</h2>
    
        <table>
        <thead>
    
            <tr>
                <td>ID</td>
                <th>Tên khách hàng </th>
                <th>Email</th>
                <th>Password</th>
                <th id=chucnang >Chức năng</th>
            </tr>
        
        </thead>
        @foreach($Customer as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->password }}</td>
        <td>
            
           
            <a href="#" onclick="event.preventDefault(); if(confirm('Bạn có chắc chắn muốn xóa người dùng này không?')) document.getElementById('delete-form-{{ $user->id }}').submit();" class="btn btn-delete">Xóa</a>
            <form id="delete-form-{{ $user->id }}" action="{{ route('deleteuser', ['id' => $user->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </td>
    </tr>
@endforeach

    </table>

    </div>
    </div>

    <script>
        function deleteuser(id) {
        if (confirm('Bạn có chắc chắn muốn xóa người dùng này không?')) {
            fetch(`/deleteuser/${id}`, {
                method: 'DELETE', // Sử dụng phương thức DELETE
                headers: {
                    'X-CSRF-TOKEN': 'pBqipQiwNmBKc2h5TMwvHVZYAaA3ZJZiFhaeLIqS'
                }
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Xóa sản phẩm không thành công!');
                }
            });
        }
    }

    </script>

    </body>
    </html>
