<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Investor extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'investors';

    protected $fillable = [
        'name', 'email', 'password', 'valid_step', 'valid_at', 'confirmed', 'confirmed_at', 'reg_attempts', 'reset_attempts', 'token',  'referred_by',
        'kyc_step', 'kyc_token', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function personal()
    {
       return $this->hasOne(InvestorPersonalFields::class);
    }

    public function history()
    {
        return $this->hasOne(InvestorHistoryFields::class);
    }
}
