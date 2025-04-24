<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $table = 'order_addresses';

    protected $primaryKey = 'ordradrs_id';

    protected $fillable = [
        'ordradrs_address',
        'ordradrs_projectowner_id',
    ];
}
