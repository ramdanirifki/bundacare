<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationDetail extends Model
{
    protected $fillable = [
        'consultation_id',
        'symptom_id',
        'cf_user'
    ];

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}
