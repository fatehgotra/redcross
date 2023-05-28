<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefereeInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',           
        'role', 
        'organisation',
        'contact_number',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
