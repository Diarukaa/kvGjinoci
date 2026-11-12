<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kampionati extends Model
{
    protected $table = 'kampionatet';

    protected $fillable = [
        'emri',
        'sezoni_id',
        'kategoria',
    ];

    public function sezoni()
    {
        return $this->belongsTo(Sezoni::class, 'sezoni_id');
    }

    public function klubet()
    {
        return $this->belongsToMany(
            Klubi::class,
            'kampionati_klubi',
            'kampionati_id',
            'klubi_id'
        );
    }
}
