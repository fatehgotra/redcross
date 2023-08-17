<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'starts_at',
        'ends_at',
        'campaign_id'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function activity(){
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
}
