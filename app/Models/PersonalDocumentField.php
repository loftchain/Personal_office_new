<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalDocumentField extends Model
{
    protected $fillable = [
        'personal_id',
      'img'
    ];

    public function personal()
    {
        return $this->belongsTo(PersonalDocumentField::class, 'id', 'personal_id');
    }
}
