<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_role',
        'moduli',
        'veprimi',
        'model_type',
        'model_id',
        'pershkrimi',
        'vlerat_vjetra',
        'vlerat_reja',
    ];

    protected function casts(): array
    {
        return [
            'vlerat_vjetra' => 'array',
            'vlerat_reja' => 'array',
        ];
    }

    public const MODULET = [
        'Perdoruesit',
        'Volejbollistet',
        'Trajneret',
        'Menaxheret',
        'Ekipet',
        'Ndeshjet',
        'Stervitjet',
        'Prezenca',
        'Statistikat',
        'Kontratat',
        'Pagat',
        'Transaksionet',
        'Sezonet',
        'Klubet',
        'Kampionatet',
    ];

    public const VEPRIMET = [
        'Krijuar',
        'Perditesuar',
        'Fshire',
    ];
}
