<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorReferralFields extends Model
{
    protected $fillable = [
        'investor_id',
        'wallet_to',
        'tokens',
        'tokens_referred_by'
    ];
}
