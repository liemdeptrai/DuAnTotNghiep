<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function showConfirmCheckout(Request $request)
{
    $cart = session('cart');

    // Kiểm tra giỏ hàng
    if (!$cart || count($cart) == 0) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    // Tính tổng giá trị đơn hàng
    $totalPrice = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));

    // Truyền dữ liệu giỏ hàng và tổng giá trị sang view
    return view('confirm_checkout', compact('cart', 'totalPrice'));
}

public function processCheckout(Request $request)
{
    $cart = session('cart');

    // Kiểm tra giỏ hàng
    if (!$cart || count($cart) == 0) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    // Tính tổng giá trị đơn hàng
    $totalPrice = array_sum(array_map(function ($item) {
        return $item['price'] * $item['quantity'];
    }, $cart));

    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
    $order = new Order();
    $order->user_id = auth()->id();
    $order->name = $request->input('name');
    $order->address = $request->input('address');
    $order->phone = $request->input('phone');
    $order->payment_method = $request->input('payment_method');
    $orders = Order::with('user')->get();
    // Gán giá trị cho cột total nếu cần

    $order->total_price = $totalPrice;
    
    $order->save();

    // Lưu từng sản phẩm trong giỏ hàng vào chi tiết đơn hàng
    foreach ($cart as $item) {
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = $order->id;
        $orderDetail->product_id = $item['id'];
        $orderDetail->quantity = $item['quantity'];
        $orderDetail->price = $item['price'];
        $orderDetail->save();
    }

    // Xóa giỏ hàng sau khi hoàn tất đặt hàng
    session()->forget('cart');

    return redirect()->route('checkout.success')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
}

public function success()
{
    return view('user.success'); // Đổi tên view nếu cần
}
    
}
