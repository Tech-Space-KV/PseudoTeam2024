<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpRatings extends Model
{
    use HasFactory;

    protected $table = 'sp_ratings';

    protected $primaryKey = 'sprtng_id';
}
