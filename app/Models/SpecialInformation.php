<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',   
        'any_police_records',        
        'any_special_needs',         
        'specify_special_needs',     
        'any_medical_conditions',    
        'specify_medical_conditions',
        'know_how_to_swim',          
        'full_covid_vaccination',    
        'date_first_vaccine',        
        'date_second_vaccine',       
        'date_booster',      
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
