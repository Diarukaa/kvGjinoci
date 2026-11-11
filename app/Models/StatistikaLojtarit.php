<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikaLojtarit extends Model
{
    protected $table = 'statistikat_lojtareve';

    protected $fillable = [
        'ndeshja_id',
        'lojtar_id',
        'kills',
        'aces',
        'blocks',
        'digs',
    ];

    public function ndeshja()
    {
        return $this->belongsTo(Ndeshja::class, 'ndeshja_id');
    }

    public function lojtar()
    {
        return $this->belongsTo(Lojtar::class, 'lojtar_id');
    }

    public function getPiketAttribute(): int
    {
        return $this->kills + $this->aces + $this->blocks;
    }
}
