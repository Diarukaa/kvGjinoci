<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klubi extends Model
{
    protected $table = 'klubet';

    protected $fillable = [
        'emri',
        'qyteti',
        'logo',
    ];

    public function kampionatet()
    {
        return $this->belongsToMany(
            Kampionati::class,
            'kampionati_klubi',
            'klubi_id',
            'kampionati_id'
        );
    }
}
