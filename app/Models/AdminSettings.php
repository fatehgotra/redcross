<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    use HasFactory;

    protected $table ='admin_settings';

    protected $fillable = [
        'setting_key',
        'setting_value',
    ];
}
