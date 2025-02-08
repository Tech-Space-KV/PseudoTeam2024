<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project_list'; // Specifies the table name

    protected $fillable = ['plist_projectid', 'plist_title', 'plits_description', 'plist_status','plist_startdate','plist_enddate','plist_type','plist_category']; // Define which columns can be mass-assigned
}


