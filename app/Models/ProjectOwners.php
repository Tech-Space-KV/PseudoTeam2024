<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOwners extends Model
{
    use HasFactory;

    protected $table = 'project_owners';

    protected $primaryKey = 'pown_id';
    protected $fillable = [
        'pown_name',
        'pown_email',
        'pown_password',
        'pown_profile_completion_flag',
    ];
}
