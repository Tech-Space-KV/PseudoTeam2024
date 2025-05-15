<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;

    protected $table = 'hardwares';

    protected $primaryKey = 'hrdws_id';

    protected $fillable = [
        'hrdws_sp_id',
        'hrdws_serial_number',
        'hrdws_model_number',
        'hrdws_qty',
        'hrdws_family',
        'hrdws_city',
        'hrdws_state',
        'hrdws_price',
        'hrdws_hw_identifier', 
        'hrdws_model_description',
    ];
    
}
