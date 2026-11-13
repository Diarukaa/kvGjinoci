@include('dashboards.panel', [

    'title' => 'Dashboard i Menaxherit',

    'roleName' => 'Menaxher',

    'description' => 'Menaxho organizimin e klubit, ekipet, lojtaret, ndeshjet dhe aktivitetet sportive.',

    'modules' => [

        [
            'icon' => '👥',
            'title' => 'Ekipet',
            'description' => 'Organizo dhe menaxho ekipet e klubit.'
        ],

        [
            'icon' => '🏐',
            'title' => 'Volejbollistet',
            'description' => 'Menaxho informacionet e lojtareve te klubit.'
        ],

        [
            'icon' => '📋',
            'title' => 'Stafi Profesional',
            'description' => 'Percjell trajneret dhe organizimin e stafit.'
        ],

        [
            'icon' => '📅',
            'title' => 'Ndeshjet',
            'description' => 'Organizo orarin dhe aktivitetet e ndeshjeve.'
        ],

        [
            'icon' => '🏆',
            'title' => 'Kampionatet',
            'description' => 'Menaxho pjesemarrjen ne liga dhe kampionate.'
        ],

        [
            'icon' => '📊',
            'title' => 'Statistikat',
            'description' => 'Analizo rezultatet dhe performancen e klubit.'
        ]

    ]

])
