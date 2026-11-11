<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seti extends Model
{
    protected $table = 'setet';

    protected $fillable = [
        'ndeshja_id',
        'numri_setit',
        'piket_tona',
        'piket_kundershtarit',
    ];

    public function ndeshja()
    {
        return $this->belongsTo(Ndeshja::class, 'ndeshja_id');
    }
}
