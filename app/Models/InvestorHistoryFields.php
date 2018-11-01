<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorHistoryFields extends Model
{
    protected $fillable = [
        'investor_id',
        'action',
        'info_1',
        'info_2',
        'date'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
