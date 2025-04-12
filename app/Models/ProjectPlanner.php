<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlanner extends Model
{
    use HasFactory;

    protected $table = 'project_planner';

    protected $primaryKey = 'pplnr_id';

    public function projectScope()
    {
        return $this->belongsTo(ProjectScope::class, 'pplnr_scope_id');
    }

}