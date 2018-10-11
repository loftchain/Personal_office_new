<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestorPersonalFields extends Model
{
    protected $fillable = [
        'investor_id',
        'name_surname',
        'phone',
        'date_place_birth',
        'doc_img_path'
    ];

    protected $casts = [
        'doc_img_path' => 'array',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
