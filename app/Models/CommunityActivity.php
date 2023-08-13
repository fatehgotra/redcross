<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityActivity extends Model
{
    use HasFactory;

    protected $table = 'community_activity';

    protected $fillable = [
        'name',
        'breif',
        'starts_at',
        'ends_at',
        'submit_by',
        'submit_to',
    ];

    public function attendees(){

        return $this->hasMany(CommunityAttendees::class,'community_id','id');
    }
    
    public function docs(){

        return $this->hasMany(CommunityDocs::class,'community_id','id');
    }

    public function submitBy(){

        return $this->belongsTo(Admin::class,'submit_by','id');
    }

    public function submitTo(){

        return $this->belongsTo(Admin::class,'submit_to','id');
    }

}
