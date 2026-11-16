<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormacionPozicioni extends Model
{
    protected $table = 'formacion_pozicionet';

    protected $fillable = [
        'ndeshja_id',
        'lojtar_id',
        'seti',
        'pozicioni',
    ];

    protected $casts = [
        'ndeshja_id' => 'integer',
        'lojtar_id' => 'integer',
        'seti' => 'integer',
        'pozicioni' => 'integer',
    ];

    public function ndeshja(): BelongsTo
    {
        return $this->belongsTo(
            Ndeshja::class,
            'ndeshja_id'
        );
    }

    public function lojtar(): BelongsTo
    {
        return $this->belongsTo(
            Lojtar::class,
            'lojtar_id'
        );
    }
}
