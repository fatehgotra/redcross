<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDetail extends Model
{
    use HasFactory;

    protected  $fillable = [
        'user_id',
        'current_employment_status',
        'current_occupation',
        'organisation_name',
        'organisation_address',
        'work_contact_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
