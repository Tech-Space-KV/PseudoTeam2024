<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOwner extends Model
{
    use HasFactory;

    protected $table = 'project_owners'; // Note: if you want to avoid spaces, better to rename it to `project_owners`
    protected $primaryKey = 'pown_id';
    public $timestamps = false; // because your created_at and updated_at are varchar
    // public $timestamps = true; // This line can be left out because it's true by default.

    protected $fillable = [
        'pown_username', 'pown_name', 'pown_user_type', 'pown_country',
        'pown_state', 'pown_address', 'pown_pincode', 'pown_contact', 'pown_email',
        'pown_date_of_registration', 'pown_about', 'pown_organisation_name', 'pown_cin',
        'pown_gstpin', 'pown_adhaar', 'pown_body', 'pown_password', 'pown_login_flag',
        'pown_adhaarfile', 'pown_profile_completion_flag', 'pown_dp', 'pown_refered_by'
    ];
}
