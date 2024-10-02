<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\admin\Orders;
use App\Models\admin\Orders_item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OdersController extends Controller
{
    public function list(){
        $cart = Orders_item::whereHas('order')
        ->with(['order.order_details', 'product', 'order.users'])
        ->get();

    $groupedCart = $cart->groupBy('product.id');
    $users = User::all();
    $order_detail = Orders_item::all();
    $orders = Orders::all();
        return view('admin.oders.list',compact('cart', 'groupedCart', 'users', 'order_detail', 'orders'));
    }
}
