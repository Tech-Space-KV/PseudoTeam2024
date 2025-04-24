<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPlannerTask extends Model
{
    use HasFactory;


    protected $table = 'project_planner_tasks';

    protected $primaryKey = 'pptasks_id';

    protected $fillable = [
        '',
        'pptasks_task_title',
        'pptasks_pt_status',
        'pptasks_date_of_completion',
    ];

    public function projectPlanner()
    {
        return $this->belongsTo(ProjectPlanner::class, 'pptasks_planner_id');
    }
}
