<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Product;
use App\Http\Controllers\Controller;
use App\Models\admin\Orders;
use App\Models\admin\Orders_item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $products = Product::all(); // Hoặc cách lấy dữ liệu khác
    return view('index', compact('products'));
}
    public function addCart($productId, $quantity)
    {
        $product = Product::findOrFail($productId);
        if (!$product) {
            abort(404, 'Không tìm thấy sản phẩm');
        }
        $order = Orders::firstOrCreate([
            'users_id' => '1',
            'status' => 'no',
        ], [
            'order_date' => now(),
            'tolal' => 0,
        ]);
        $orderDetail = new Orders_item([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price
        ]);
        $order->order_details()->save($orderDetail);
        $order->update([
            'tolal' => $product->price * $quantity,
        ]);
        return redirect()->route('index')->with('success', 'Thêm sản phẩm thành công');
    }
}
