<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutpassController extends Controller
{
    public function checkoutpass(){
        return view('user.checkoutpass');
    }
}
