<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagesa extends Model
{
    protected $table = 'pagesat';

    protected $fillable = [
        'kontrata_id',
        'muaji',
        'shuma',
        'statusi',
        'data_pageses',
        'metoda_pageses',
        'shenime',
    ];

    protected function casts(): array
    {
        return [
            'shuma' => 'decimal:2',
            'muaji' => 'date',
            'data_pageses' => 'date',
        ];
    }

    public function kontrata(): BelongsTo
    {
        return $this->belongsTo(
            Kontrata::class,
            'kontrata_id'
        );
    }
}
