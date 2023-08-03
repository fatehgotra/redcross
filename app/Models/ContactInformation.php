<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resedential_address',
        'community_name',
        'community_type',
        'province',
        'district',
        'postal_address',
        'email',
        'landline_contact',
        'primary_mobile_contact_number',
        'primary_mobile_network_provider',
        'other_contact_numbers',
        'full_name_of_emergency_contact',
        'relationship',
        'resedential_address_separate',
        'contact_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
