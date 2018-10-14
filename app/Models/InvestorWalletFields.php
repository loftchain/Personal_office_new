<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorWalletFields extends Model
{
    protected $fillable = [
        'investor_id',
        'currency',
        'type',
        'wallet'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
