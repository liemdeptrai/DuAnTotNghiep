<?php
namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\admin\Orders;
use App\Models\admin\Orders_item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(){
        $cart = Orders_item::whereHas('order')
            ->with(['order.order_details', 'product', 'order.users'])
            ->get();

        $groupedCart = $cart->groupBy('product.id');
        $users = User::all();
        $order_detail = Orders_item::all();
        $orders = Orders::all();
        return view('user.checkout', compact('cart', 'groupedCart', 'users', 'order_detail', 'orders'));
    }
    public function destroy($orderDetail)
    {

        $orderDetail = Orders_item::find($orderDetail);

        if (!$orderDetail) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $orderDetail->delete();

        session()->flash('success', 'Xóa thành công');

        return redirect()->route('user.checkout');
    }
    public function processCheckout(Request $request)
{
    return redirect()->route('cart.index')->with('success', 'Thanh toán thành công!');
}
}
