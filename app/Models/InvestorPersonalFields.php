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
        'telegram',
        'permanent_address',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function documents()
    {
        return $this->hasMany(PersonalDocumentField::class, 'personal_id', 'id');
    }
}
