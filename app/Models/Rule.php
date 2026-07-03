<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'code',
        'symptoms',
        'diagnosis_id',
        'cf_expert'
    ];

    public function diagnosis()
    {
        return $this->belongsTo(
            Diagnosis::class
        );
    }
}
