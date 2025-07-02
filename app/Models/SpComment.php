<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpComment extends Model
{
    use HasFactory;

    protected $table = 'task_conversation';

    protected $primaryKey = 'tconv_id';

    protected $fillable = [
        'tconv_comment',
        'tconv_comment_by_sp_id',
        'tconv_task_id',
        'tconv_comment_date_time',
    ];
}
