<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sezoni extends Model
{
    protected $table = 'sezonet';

    protected $fillable = [
        'emri',
        'data_fillimit',
        'data_mbarimit',
        'aktiv',
    ];

    protected $casts = [
        'aktiv' => 'boolean',
        'data_fillimit' => 'date',
        'data_mbarimit' => 'date',
    ];

    public function ndeshjet()
    {
        return $this->hasMany(Ndeshja::class, 'sezoni_id');
    }

    public function kampionatet()
    {
        return $this->hasMany(
            Kampionati::class,
            'sezoni_id'
        );
    }

    public function stervitjet()
    {
        return $this->hasMany(Stervitja::class, 'sezoni_id');
    }
}
