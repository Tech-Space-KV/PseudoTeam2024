<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralTable extends Model
{
    use HasFactory;

    protected $table = 'referrals';

    protected $primaryKey = 'rfrls_id';

    protected $fillable = [
        'rfrls_user_id',
        'rfrls_email_id',
        'rfrls_promo_code',
        'rfrls_user_type',
    ];
}
