<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';

    protected $fillable = [
     'bank',
     'branch',
     'account',
     'account_name'
    ];
}
