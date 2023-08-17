<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasFactory;

    protected $table = 'flag';

    protected $fillable = [
        
        'campaign_id',
        'community_id',
        'activity_id',
        'user_id',
        'reason'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
