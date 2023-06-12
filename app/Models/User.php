<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable =  [
        'firstname',
        'lastname',
        'email',
        'phone',
        'password',
        'avatar',
        'status',
        'approved_by',
        'approver_id',
        'decline_reason'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lodgementInformation()
    {
        return $this->hasOne(LodgementInformation::class, 'user_id', 'id');
    }

    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class, 'user_id', 'id');
    }
    
    public function contactInformation()
    {
        return $this->hasOne(ContactInformation::class, 'user_id', 'id');
    }

    public function validNationalIdentification()
    {
        return $this->hasOne(ValidNationalIdentification::class, 'user_id', 'id');
    }

    public function employmentDetail()
    {
        return $this->hasOne(EmploymentDetail::class, 'user_id', 'id');
    }

    public function educationBackgroud()
    {
        return $this->hasOne(EducationBackground::class, 'user_id', 'id');
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class, 'user_id', 'id');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class, 'user_id', 'id');
    }

    public function specialInformation()
    {
        return $this->hasOne(SpecialInformation::class, 'user_id', 'id');
    }

    public function bloodInformation()
    {
        return $this->hasOne(BloodInformation::class, 'user_id', 'id');
    }

    public function volunteers()
    {
        return $this->hasMany(VolunteeringInformation::class, 'user_id', 'id');
    }

    public function serviceInterest()
    {
        return $this->hasOne(ServiceInterest::class, 'user_id', 'id');
    }

    public function personalBankingInformation()
    {
        return $this->hasOne(PersonalBankingInformation::class, 'user_id', 'id');
    }

    public function mobileBankingInformation()
    {
        return $this->hasOne(MobileBankingInformation::class, 'user_id', 'id');
    }

    public function referees()
    {
        return $this->hasMany(RefereeInformation::class, 'user_id', 'id');
    }

    public function consents()
    {
        return $this->hasOne(Consent::class, 'user_id', 'id');
    }

    public function checks()
    {
        return $this->hasOne(Check::class, 'user_id', 'id');
    }
}
