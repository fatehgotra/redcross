<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'statutory_declaration_attached',
        'code_of_conduct_attached',
        'signed_child_protection_policy_attached',
        'cv_attached',
        'base_location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
