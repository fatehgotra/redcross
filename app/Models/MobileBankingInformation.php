<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileBankingInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mobile_bank',           
        'mobile_bank_number', 
        'name_mobile_bank_account'
    ];
}
