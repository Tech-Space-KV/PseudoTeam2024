<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'project_conversation';

    protected $primaryKey = 'pconv_id';

    protected $fillable = [
        'pconv_comment',
        'pconv_comment_by_cust_id',
        'pconv_scope_id',
        'pconv_comment_date_time',
    ];
}
