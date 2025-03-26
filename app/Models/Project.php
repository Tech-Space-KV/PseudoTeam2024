<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Implmented by sanskar

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'plist_id';
    protected $table = 'project_list';

    protected $fillable = [
        'plist_id',
        'plist_customer_id',
        'plist_projectid',
        'plist_title',
        'plist_description',
        'plist_sow',
        'plist_ongnew',
        'plist_type',
        'plist_startdate',
        'plist_enddate',
        'plist_currency',
        'plist_budget',
        'plist_checkrcv',
        'plist_name',
        'plist_email',
        'plist_contact',
        'plist_status',
        'plist_project_status',
        'plist_category',
        'plist_coupon',
        'created_at',
        'updated_at',
    ];
}

