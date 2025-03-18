<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    protected $primaryKey = 'cart_id';

    protected $fillable = [
        "cart_order_no",
        "cart_hw_id",
        "cart_qty",
        "cart_customer_id",
        ];
}
