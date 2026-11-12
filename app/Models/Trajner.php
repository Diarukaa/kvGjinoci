<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trajner extends Model
{
    protected $table = 'trajner';

    protected $fillable = [
        'emri',
        'mbiemri',
        'email',
        'dataELindjes',
        'nrTelefonit',
        'vendbanimi',
        'IBAN',
    ];

    public function ekipet()
    {
        return $this->hasMany(Ekipi::class, 'trajner_id');
    }

    public function stervitjet()
    {
        return $this->hasMany(Stervitja::class, 'trajner_id');
    }
}
