<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityDocs extends Model
{
    use HasFactory;

    protected $table = 'community_doc';

    protected $fillable = [
        'community_id',
        'type',
        'doc',
    ];
}
