<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lojtar extends Model
{
    protected $table = 'lojtar';

    protected $fillable = [
        'emri',
        'mbiemri',
        'email',
        'dataELindjes',
        'nrTelefonit',
        'vendbanimi',
        'numriFanelles',
        'pozicioni',
        'gjatesia',
        'ekipi_id'
    ];

    public function ekipi()
    {
        return $this->belongsTo(Ekipi::class, 'ekipi_id');
    }

    public function statistikat()
    {
        return $this->hasMany(
            StatistikaLojtarit::class,
            'lojtar_id'
        );
    }

    public function prezencat()
    {
        return $this->hasMany(
            Prezenca::class,
            'lojtar_id'
        );
    }
}
