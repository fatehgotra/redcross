<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidNationalIdentification extends Model
{
    use HasFactory;

    protected  $fillable = [
        'user_id',
        'photo_id_card_type',        
        'specify_photo_id_card_type',
        'id_card_number',            
        'id_expiry_date',            
        'tin',                       
        'photo_id', 
    ];
}
