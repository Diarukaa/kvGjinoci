<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ActivityLogService
{
    private const MODELET = [

        'User' => [
            'moduli' => 'Perdoruesit',
            'fields' => [
                'name',
                'role',
                'trajner_id',
                'lojtar_id',
                'manager_id',
            ],
        ],

        'Lojtar' => [
            'moduli' => 'Volejbollistet',
            'fields' => [
                'emri',
                'mbiemri',
                'ekipi_id',
                'pozicioni',
                'gjatesia',
                'numri_fanelles',
                'statusi',
            ],
        ],

        'Trajner' => [
            'moduli' => 'Trajneret',
            'fields' => [
                'emri',
                'mbiemri',
                'statusi',
            ],
        ],

        'Manager' => [
            'moduli' => 'Menaxheret',
            'fields' => [
                'emri',
                'mbiemri',
                'statusi',
            ],
        ],

        'Ekipi' => [
            'moduli' => 'Ekipet',
            'fields' => [
                'emri',
                'kategoria',
                'trajner_id',
                'klubi_id',
            ],
        ],

        'Ndeshja' => [
            'moduli' => 'Ndeshjet',
            'fields' => [
                'ekipi_id',
                'kundershtari',
                'data_ndeshjes',
                'palestra',
                'lokacioni',
                'statusi',
                'setet_tona',
                'setet_kundershtarit',
                'sezoni_id',
            ],
        ],

        'Stervitja' => [
            'moduli' => 'Stervitjet',
            'fields' => [
                'ekipi_id',
                'trajner_id',
                'sezoni_id',
                'data',
                'ora_fillimit',
                'ora_mbarimit',
                'palestra',
                'lloji',
                'statusi',
            ],
        ],

        'Prezenca' => [
            'moduli' => 'Prezenca',
            'fields' => [
                'stervitja_id',
                'lojtar_id',
                'statusi',
            ],
        ],

        'StatistikaLojtarit' => [
            'moduli' => 'Statistikat',
            'fields' => [
                'ndeshja_id',
                'lojtar_id',
                'kills',
                'aces',
                'blocks',
                'digs',
            ],
        ],

        'Kontrata' => [
            'moduli' => 'Kontratat',
            'fields' => [
                'user_id',
                'numri_kontrates',
                'roli',
                'paga_mujore',
                'data_fillimit',
                'data_mbarimit',
                'statusi',
            ],
        ],

        'Pagesa' => [
            'moduli' => 'Pagat',
            'fields' => [
                'kontrata_id',
                'muaji',
                'shuma',
                'statusi',
                'data_pageses',
                'metoda_pageses',
            ],
        ],

        'Transaksioni' => [
            'moduli' => 'Transaksionet',
            'fields' => [
                'lloji',
                'kategoria',
                'pershkrimi',
                'shuma',
                'data',
                'metoda_pageses',
            ],
        ],

        'Sezoni' => [
            'moduli' => 'Sezonet',
            'fields' => [
                'emri',
                'data_fillimit',
                'data_mbarimit',
                'statusi',
            ],
        ],

        'Klubi' => [
            'moduli' => 'Klubet',
            'fields' => [
                'emri',
                'qyteti',
                'statusi',
            ],
        ],

        'Kampionati' => [
            'moduli' => 'Kampionatet',
            'fields' => [
                'emri',
                'sezoni_id',
                'lloji',
                'statusi',
                'data_fillimit',
                'data_mbarimit',
            ],
        ],

    ];

    public function record(
        Model $model,
        string $veprimi
    ): void {

        $modelName = class_basename($model);

        $config = self::MODELET[$modelName] ?? null;

        if (!$config) {
            return;
        }

        $fields = $config['fields'];

        $vleratVjetra = [];

        $vleratReja = [];

        switch ($veprimi) {

            case 'Krijuar':

                $vleratReja = Arr::only(
                    $model->getAttributes(),
                    $fields
                );

                break;

            case 'Perditesuar':

                $ndryshimet = Arr::only(
                    $model->getChanges(),
                    $fields
                );

                foreach ($ndryshimet as $field => $value) {

                    $vleraVjeter = $model
                        ->getRawOriginal($field);

                    if ($vleraVjeter === $value) {
                        continue;
                    }

                    $vleratVjetra[$field] = $vleraVjeter;

                    $vleratReja[$field] = $value;

                }

                // Mos regjistro ndryshime pa rendesi,
                // p.sh. vetem updated_at.

                if (
                    empty($vleratReja)
                    && !$this->ndryshimSigurie($model)
                ) {
                    return;
                }

                break;

            case 'Fshire':

                $vleratVjetra = Arr::only(
                    $model->getAttributes(),
                    $fields
                );

                break;

            default:

                return;

        }

        $user = auth()->user();

        $pershkrimi = $this->pershkrimi(
            $model,
            $veprimi,
            $config['moduli']
        );

        if (
            $veprimi === 'Perditesuar'
            && $modelName === 'User'
        ) {

            $ndryshimeSigurie = [];

            if ($model->wasChanged('password')) {

                $ndryshimeSigurie[] =
                    'Fjalekalimi u ndryshua';

            }

            if ($model->wasChanged('email')) {

                $ndryshimeSigurie[] =
                    'Emaili u ndryshua';

            }

            if ($model->wasChanged('profile_photo')) {

                $ndryshimeSigurie[] =
                    'Fotoja e profilit u ndryshua';

            }

            if (!empty($ndryshimeSigurie)) {

                $pershkrimi .= ' | '
                    . implode(', ', $ndryshimeSigurie);

            }
        }

        ActivityLog::create([

            'user_id' => $user?->id,

            'user_name' => $user?->name ?? 'Sistemi',

            'user_role' => $user?->role,

            'moduli' => $config['moduli'],

            'veprimi' => $veprimi,

            'model_type' => get_class($model),

            'model_id' => (string) $model->getKey(),

            'pershkrimi' => $pershkrimi,

            'vlerat_vjetra' =>
                empty($vleratVjetra)
                    ? null
                    : $vleratVjetra,

            'vlerat_reja' =>
                empty($vleratReja)
                    ? null
                    : $vleratReja,

        ]);
    }

    private function ndryshimSigurie(
        Model $model
    ): bool {

        return class_basename($model) === 'User'
            && $model->wasChanged([
                'password',
                'email',
                'profile_photo',
            ]);
    }

    private function pershkrimi(
        Model $model,
        string $veprimi,
        string $moduli
    ): string {

        $emri = trim(
            (string) ($model->getAttribute('emri') ?? '')
            . ' '
            . (string) ($model->getAttribute('mbiemri') ?? '')
        );

        $label = match(class_basename($model)) {

            'User' =>
            $model->getAttribute('name'),

            'Ndeshja' =>
                'Ndeshja kunder '
                . $model->getAttribute('kundershtari'),

            'Kontrata' =>
                'Kontrata '
                . $model->getAttribute('numri_kontrates'),

            'Pagesa' =>
                'Paga #' . $model->getKey()
                . ' - '
                . $model->getAttribute('shuma')
                . ' EUR',

            'Transaksioni' =>
                $model->getAttribute('pershkrimi')
                . ' - '
                . $model->getAttribute('shuma')
                . ' EUR',

            default =>
            $emri ?: '#' . $model->getKey(),

        };

        return mb_substr(
            $veprimi . ' | '
            . $moduli . ' | '
            . ($label ?: '#' . $model->getKey()),
            0,
            255
        );
    }
}
