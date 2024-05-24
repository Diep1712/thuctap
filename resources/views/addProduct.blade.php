<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    
    <style>
        .container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Thêm Sản Phẩm</h1>
        <form action='{{route('getaddProduct')}}' method="POST"> 
        @csrf
            <div class="form-group">
                <label for="productName">Tên Sản Phẩm:</label>
                <input type="text" id="productName" name="productName" >
            </div>
            <div class="form-group">
                <label for="productPrice">Giá Tiền:</label>
                <input type="number" id="productPrice" name="productPrice" >
            </div>
            <div class="form-group">
                <label for="productImage">Ảnh Sản Phẩm:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" >
            </div>
            <div class="form-group">
                <label for="productDescription">Thông Tin Chi Tiết:</label>
                <textarea id="productDescription" name="productDescription" rows="4" ></textarea>
            </div>
            <button style="background-color:coral"type="submit">Thêm Sản Phẩm</button>
        </form>
    </div>
</body>
</html>
