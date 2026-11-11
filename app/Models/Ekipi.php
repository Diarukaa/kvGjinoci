<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ekipi extends Model
{
    protected $table = 'ekipet';

    protected $fillable = [
        'emri',
        'kategoria',
        'trajner_id',
    ];

    public function trajner(): BelongsTo
    {
        return $this->belongsTo(Trajner::class, 'trajner_id');
    }

    public function lojtaret(): HasMany
    {
        return $this->hasMany(Lojtar::class, 'ekipi_id');
    }

    public function ndeshjet()
    {
        return $this->hasMany(Ndeshja::class, 'ekipi_id');
    }
}
