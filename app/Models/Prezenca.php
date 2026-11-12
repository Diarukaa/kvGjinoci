<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prezenca extends Model
{
    protected $table = 'prezencat';

    protected $fillable = [
        'stervitja_id',
        'lojtar_id',
        'statusi',
        'shenime',
    ];

    public function stervitja()
    {
        return $this->belongsTo(
            Stervitja::class,
            'stervitja_id'
        );
    }

    public function lojtar()
    {
        return $this->belongsTo(
            Lojtar::class,
            'lojtar_id'
        );
    }
}
