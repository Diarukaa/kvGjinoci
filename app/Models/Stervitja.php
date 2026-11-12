<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stervitja extends Model
{
    protected $table = 'stervitjet';

    protected $fillable = [
        'ekipi_id',
        'trajner_id',
        'sezoni_id',
        'data',
        'ora_fillimit',
        'ora_mbarimit',
        'palestra',
        'lloji',
        'statusi',
        'pershkrimi',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    public function ekipi()
    {
        return $this->belongsTo(Ekipi::class, 'ekipi_id');
    }

    public function trajner()
    {
        return $this->belongsTo(Trajner::class, 'trajner_id');
    }

    public function sezoni()
    {
        return $this->belongsTo(Sezoni::class, 'sezoni_id');
    }
}
