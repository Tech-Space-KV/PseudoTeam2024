<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectScope extends Model
{
    use HasFactory;

    protected $table = 'project_scope';

    protected $primaryKey = 'pscope_id';
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'pscope_project_id');
    }
}
