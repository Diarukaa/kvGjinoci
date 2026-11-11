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
    ];
}
