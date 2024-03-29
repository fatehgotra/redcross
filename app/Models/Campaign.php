<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable =  [
        'title',
        'description',
        'status'
    ];

    public function attendences()
    {
        return $this->hasMany(CampaignAttendance::class, 'campaign_id');
    }
}
