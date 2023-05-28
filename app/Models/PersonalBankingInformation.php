<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalBankingInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank',           
        'account_number', 
        'name_bank_account'
    ];
   
}
