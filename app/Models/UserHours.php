<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHours extends Model
{
    use HasFactory;

    protected $fillable = [

        'email',
        'date',
        'start_time',
        'end_time',
        'comment'
    ];

    public function user(){

        return $this->belongsTo(User::class,'email','email');
    }
}
