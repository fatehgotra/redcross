<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userHours extends Model
{
    use HasFactory;

    protected $table = "user_hours";

    protected $fillable = [
        'email',
        'date',
        'start_time',
        'end_time',
        'added_by',
    ];
}
