@extends('layouts.club')

@section('title', 'Njoftimet - KV Gjinoci')

@section('content')

    <style>
        .nf-page {
            max-width: 1050px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .nf-page * {
            box-sizing: border-box;
        }

        .nf-hero {
            background: linear-gradient(120deg,#172b4d,#315b89);
            color: white;
            padding: 32px;
            border-radius: 20px;
            margin-bottom: 24px;
        }

        .nf-hero small {
            color: #bfdbfe;
            letter-spacing: 1.5px;
            font-weight: bold;
            font-size: 11px;
        }

        .nf-hero h1 {
            color: white !important;
            font-size: 32px;
            margin: 14px 0;
        }

        .nf-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .nf-stats {
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .nf-stat {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 22px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .nf-stat small {
            color: #64748b;
            font-size: 13px;
        }

        .nf-stat h2 {
            margin: 14px 0 0;
            font-size: 29px;
        }

        .nf-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
        }

        .nf-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 24px;
        }

        .nf-tabs {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .nf-tab {
            display: inline-block;
            padding: 11px 15px;
            border-radius: 8px;
            color: #64748b !important;
            font-size: 13px;
            font-weight: bold;
            background: #f8fafc;
            text-decoration: none !important;
        }

        .nf-tab.active {
            background: #253858;
            color: white !important;
        }

        .nf-btn {
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            background: #253858;
            color: white !important;
            font-weight: bold;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none !important;
        }

        .nf-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .nf-btn-delete {
            background: #fee2e2;
            color: #b91c1c !important;
        }

        .nf-btn:disabled {
            cursor: not-allowed;
            opacity: .5;
        }

        .nf-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 22px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 13px;
            background: white;
        }

        .nf-item.unread {
            background: #f0f6ff;
            border-color: #dbeafe;
            border-left: 4px solid #2563eb;
        }

        .nf-icon {
            width: 48px;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
            background: #e8efff;
            font-size: 22px;
            flex-shrink: 0;
        }

        .nf-content {
            flex: 1;
            min-width: 0;
        }

        .nf-heading {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
        }

        .nf-heading h3 {
            font-size: 16px;
            margin: 0;
        }

        .nf-dot {
            width: 8px;
            height: 8px;
            background: #2563eb;
            border-radius: 50%;
            display: inline-block;
        }

        .nf-content p {
            color: #475569;
            font-size: 13px;
            line-height: 1.7;
            margin: 10px 0;
        }

        .nf-time {
            font-size: 11px;
            color: #64748b;
        }

        .nf-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 7px;
            margin-top: 15px;
        }

        .nf-actions form,
        .nf-toolbar form {
            margin: 0;
        }

        .nf-empty {
            text-align: center;
            padding: 55px 20px;
            color: #64748b;
        }

        .nf-empty span {
            display: block;
            font-size: 38px;
            margin-bottom: 18px;
        }

        .nf-success {
            background: #dcfce7;
            color: #166534;
            padding: 15px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        @media(max-width: 600px) {

            .nf-hero,
            .nf-card {
                padding: 19px;
            }

            .nf-hero h1 {
                font-size: 25px;
            }

            .nf-stat {
                padding: 14px;
            }

            .nf-stat h2 {
                font-size: 23px;
            }

            .nf-stat small {
                font-size: 11px;
            }

            .nf-stats {
                gap: 8px;
            }

            .nf-item {
                padding: 14px;
                gap: 11px;
            }

            .nf-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .nf-tab {
                padding: 9px 11px;
                font-size: 11px;
            }
        }
    </style>

    @php
        $icons = [
            'ndeshje' => '🏐',
            'stervitje' => '📅',
            'rezultat' => '🏆',
            'pagese' => '💰',
            'kontrate' => '📄',
            'informacion' => '🔔',
        ];
    @endphp

    <div class="nf-page">

        <div class="nf-hero">

            <small>KV GJINOCI | NOTIFICATION CENTER</small>

            <h1>🔔 Njoftimet e Mia</h1>

            <p>
                Percjell aktivitetet, ndeshjet, stervitjet
                dhe njoftimet e rendesishme te klubit.
            </p>

        </div>

        @if(session('success'))

            <div class="nf-success">
                {{ session('success') }}
            </div>

        @endif

        <div class="nf-stats">

            <div class="nf-stat">

                <small>Te gjitha</small>

                <h2>{{ $totalNjoftime }}</h2>

            </div>

            <div class="nf-stat">

                <small>Te palexuara</small>

                <h2 style="color:#2563eb;">
                    {{ $totalPalexuara }}
                </h2>

            </div>

            <div class="nf-stat">

                <small>Te lexuara</small>

                <h2 style="color:#15803d;">
                    {{ $totalLexuara }}
                </h2>

            </div>

        </div>

        <div class="nf-card">

            <div class="nf-toolbar">

                <div class="nf-tabs">

                    @foreach([
                        'all' => 'Te gjitha',
                        'unread' => 'Te palexuara',
                        'read' => 'Te lexuara'
                    ] as $value => $label)

                        <a href="{{ route('njoftimet.index', [
                        'filter' => $value
                    ]) }}"
                           class="nf-tab {{ $filter === $value ? 'active' : '' }}">

                            {{ $label }}

                        </a>

                    @endforeach

                </div>

                <form method="POST"
                      action="{{ route('njoftimet.lexo-krejt') }}">

                    @csrf

                    <button type="submit"
                            class="nf-btn nf-btn-light"
                        @disabled($totalPalexuara === 0)>

                        ✓ Lexo te gjitha

                    </button>

                </form>

            </div>

            @forelse($njoftimet as $njoftimi)

                @php
                    $data = $njoftimi->data;

                    $lloji = $data['lloji']
                        ?? 'informacion';

                    $unread = is_null($njoftimi->read_at);
                @endphp

                <div class="nf-item {{ $unread ? 'unread' : '' }}">

                    <div class="nf-icon">

                        {{ $icons[$lloji] ?? '🔔' }}

                    </div>

                    <div class="nf-content">

                        <div class="nf-heading">

                            <h3>

                                {{ $data['titulli'] ?? 'Njoftim' }}

                            </h3>

                            @if($unread)

                                <span class="nf-dot"></span>

                            @endif

                        </div>

                        <p>

                            {{ $data['mesazhi'] ?? '' }}

                        </p>

                        <span class="nf-time">

                        {{ $njoftimi->created_at->format('d.m.Y H:i') }}

                        |

                        {{ $unread ? 'E palexuar' : 'E lexuar' }}

                    </span>

                        <div class="nf-actions">

                            <form method="POST"
                                  action="{{ route(
                                  'njoftimet.hap',
                                  $njoftimi->id
                              ) }}">

                                @csrf

                                <button type="submit" class="nf-btn">

                                    Shiko Detajet

                                </button>

                            </form>

                            @if($unread)

                                <form method="POST"
                                      action="{{ route(
                                      'njoftimet.lexo',
                                      $njoftimi->id
                                  ) }}">

                                    @csrf

                                    <button type="submit"
                                            class="nf-btn nf-btn-light">

                                        ✓ Sheno si te lexuar

                                    </button>

                                </form>

                            @endif

                            <form method="POST"
                                  action="{{ route(
                                  'njoftimet.destroy',
                                  $njoftimi->id
                              ) }}"
                                  onsubmit="return confirm('A deshiron ta fshish kete njoftim?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="nf-btn nf-btn-delete">

                                    Fshi

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="nf-empty">

                    <span>🔔</span>

                    <h3>Nuk ka njoftime</h3>

                    <p>
                        Nuk ke njoftime per filtrin e zgjedhur.
                    </p>

                </div>

            @endforelse

            <div style="margin-top:22px;">

                {{ $njoftimet->links() }}

            </div>

        </div>

    </div>

@endsection
