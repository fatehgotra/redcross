<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityAttendence extends Model
{
    use HasFactory;

    protected $table = "community_attendence";

    protected $fillable = [

        'email',
        'activity_id',
        'date',
        'starts_at',
        'ends_at',
        'added_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function activity()
    {
        return $this->belongsTo(CommunityActivity::class, 'activity_id');
    }
}
