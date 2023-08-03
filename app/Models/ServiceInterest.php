<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_interest',
        'available_days',  
        'available_times', 
        'other_skills'
    ];

    protected $casts = [
        'service_interest' => 'array',
        'available_days' => 'array',
        'available_times' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
