<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $table = 'service_providers';

    protected $primaryKey = 'sprov_id';

    protected $fillable = [
        'sprov_name',
        'sprov_email',
        'sprov_contact',
        'sprov_password',
        'sprov_user_type',
        'sprov_country',
        'sprov_state',
        'sprov_pincode',
        'sprov_address',
        'sprov_profile_completion_flag',
    ];
}
