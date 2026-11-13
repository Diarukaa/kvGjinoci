<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function trajner(): BelongsTo
    {
        return $this->belongsTo(
            Trajner::class,
            'trajner_id'
        );
    }

    public function lojtar(): BelongsTo
    {
        return $this->belongsTo(
            Lojtar::class,
            'lojtar_id'
        );
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    public function isCoach(): bool
    {
        return $this->role === 'coach';
    }

    public function isPlayer(): bool
    {
        return $this->role === 'player';
    }

    public function hasRole(string ...$roles): bool
    {
        return in_array(
            $this->role,
            $roles,
            true
        );
    }
}
