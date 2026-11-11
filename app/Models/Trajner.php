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
}
