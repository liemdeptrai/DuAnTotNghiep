<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Product;
class OrderDetail extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
