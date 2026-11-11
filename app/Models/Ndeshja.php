<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ndeshja extends Model
{
    protected $table = 'ndeshjet';

    protected $fillable = [
        'ekipi_id',
        'kundershtari',
        'data_ndeshjes',
        'palestra',
        'lokacioni',
        'statusi',
        'setet_tona',
        'setet_kundershtarit',
        'sezoni_id',
    ];

    protected $casts = [
        'data_ndeshjes' => 'datetime',
    ];

    public function ekipi()
    {
        return $this->belongsTo(Ekipi::class, 'ekipi_id');
    }

    public function setet()
    {
        return $this->hasMany(Seti::class, 'ndeshja_id')
            ->orderBy('numri_setit');
    }

    public function statistikat()
    {
        return $this->hasMany(
            StatistikaLojtarit::class,
            'ndeshja_id'
        );
    }

    public function sezoni()
    {
        return $this->belongsTo(Sezoni::class, 'sezoni_id');
    }
}
