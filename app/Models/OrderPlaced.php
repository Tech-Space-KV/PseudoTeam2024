<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPlaced extends Model
{
    use HasFactory;

    protected $table = 'orders_placed';

    protected $primaryKey = 'ordplcd_id';

    protected $fillable = [
        'ordplcd_hw_id',
        'ordplcd_customer_id',
        'ordplcd_qty_placed',
        'ordplcd_order_no',
        'ordplcd_amt',
        'ordplcd_status',
        'ordplcd_order_date',
    ] ;
}
