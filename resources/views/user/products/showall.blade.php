<!DOCTYPE html>
<html>
<head>
    <title>All Products</title>
</head>
<body>
    <h1>Tất cả sản phẩm</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100px;"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
