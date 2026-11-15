<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kontrata extends Model
{
    protected $table = 'kontratat';

    protected $fillable = [
        'user_id',
        'numri_kontrates',
        'roli',
        'paga_mujore',
        'data_fillimit',
        'data_mbarimit',
        'statusi',
        'shenime',
    ];

    protected function casts(): array
    {
        return [
            'paga_mujore' => 'decimal:2',
            'data_fillimit' => 'date',
            'data_mbarimit' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pagesat(): HasMany
    {
        return $this->hasMany(
            Pagesa::class,
            'kontrata_id'
        );
    }

    public function eshteAktive(): bool
    {
        return $this->statusi === 'Aktive'
            && $this->data_fillimit->lte(today())
            && $this->data_mbarimit->gte(today());
    }

    public function getGjendjaAttribute(): string
    {
        if ($this->statusi === 'Nderprere') {
            return 'Nderprere';
        }

        if ($this->data_mbarimit->lt(today())) {
            return 'Skaduar';
        }

        if ($this->data_fillimit->gt(today())) {
            return 'E ardhshme';
        }

        return 'Aktive';
    }
}
