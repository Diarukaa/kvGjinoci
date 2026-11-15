<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksioni extends Model
{
    protected $table = 'transaksionet';

    protected $fillable = [
        'user_id',
        'lloji',
        'kategoria',
        'pershkrimi',
        'shuma',
        'data',
        'metoda_pageses',
        'referenca',
        'shenime',
    ];

    protected function casts(): array
    {
        return [
            'shuma' => 'decimal:2',
            'data' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public const KATEGORITE = [
        'Hyrje' => [
            'Sponsorizime',
            'Donacione',
            'Bileta',
            'Anetaresi',
            'Subvencione',
            'Te tjera',
        ],

        'Shpenzim' => [
            'Transport',
            'Palestra',
            'Pajisje',
            'Udhetime',
            'Ushqim',
            'Akomodim',
            'Sherbime mjekesore',
            'Marketing',
            'Te tjera',
        ],
    ];
}
