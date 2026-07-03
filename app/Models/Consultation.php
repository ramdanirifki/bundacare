<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [

        'user_id',
        'diagnosis_id',
        'score',
        'reason',
        'alternatives'

    ];

    protected $casts = [

        'alternatives' => 'array'

    ];

    public function diagnosis()
    {
        return $this->belongsTo(
            Diagnosis::class
        );
    }

    public function details()
    {
        return $this->hasMany(
            ConsultationDetail::class
        );
    }
}
