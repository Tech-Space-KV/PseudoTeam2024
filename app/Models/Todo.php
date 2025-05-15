<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $primaryKey = 'td_id'; // <-- your real primary key name
    public $incrementing = true; // or false if not auto-increment
    protected $keyType = 'int'; // or 'string' if not integer

    protected $table = 'todo';
    public $timestamps = false;

    protected $fillable = [
        'td_user_id',
        'td_user_type',
        'td_event',
        'td_date',
    ];
}
