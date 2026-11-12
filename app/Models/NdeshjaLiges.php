<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NdeshjaLiges extends Model
{
    protected $table = 'ndeshjet_liges';

    protected $fillable = [
        'kampionati_id',
        'klubi_vendas_id',
        'klubi_mysafir_id',
        'data_ndeshjes',
        'setet_vendas',
        'setet_mysafir',
    ];

    protected $casts = [
        'data_ndeshjes' => 'date',
        'setet_vendas' => 'integer',
        'setet_mysafir' => 'integer',
    ];

    public function kampionati()
    {
        return $this->belongsTo(
            Kampionati::class,
            'kampionati_id'
        );
    }

    public function vendas()
    {
        return $this->belongsTo(
            Klubi::class,
            'klubi_vendas_id'
        );
    }

    public function mysafir()
    {
        return $this->belongsTo(
            Klubi::class,
            'klubi_mysafir_id'
        );
    }
}
