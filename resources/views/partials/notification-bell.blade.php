@auth

    @php
        $bellUser = auth()->user();

        $bellCount = $bellUser
            ->unreadNotifications()
            ->count();

        $bellItems = $bellUser
            ->notifications()
            ->latest()
            ->limit(5)
            ->get();

        $bellIcons = [
            'ndeshje' => '🏐',
            'stervitje' => '📅',
            'rezultat' => '🏆',
            'pagese' => '💰',
            'kontrate' => '📄',
            'informacion' => '🔔',
        ];
    @endphp

    <style>
        .nb-wrapper {
            position: relative;
            display: inline-block;
            color: #172b4d;
        }

        .nb-wrapper summary {
            list-style: none;
        }

        .nb-wrapper summary::-webkit-details-marker {
            display: none;
        }

        .nb-bell {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 11px;
            cursor: pointer;
            position: relative;
        }

        .nb-bell svg {
            width: 22px;
            height: 22px;
            color: white;
        }

        .nb-count {
            position: absolute;
            top: -7px;
            right: -7px;
            background: #ef4444;
            color: white;
            border: 2px solid #172b4d;
            min-width: 21px;
            height: 21px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .nb-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 13px);
            width: 355px;
            max-width: calc(100vw - 36px);
            background: white;
            color: #172b4d;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 12px 45px rgba(15,23,42,.18);
            z-index: 9999;
            overflow: hidden;
        }

        .nb-header {
            padding: 18px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nb-header strong {
            font-size: 15px;
        }

        .nb-header small {
            font-size: 11px;
            color: #64748b;
        }

        .nb-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .nb-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            background: white;
            width: 100%;
            text-align: left;
            font-family: inherit;
            cursor: pointer;
            border-top: 0;
            border-left: 0;
            border-right: 0;
            color: #172b4d;
        }

        .nb-item.unread {
            background: #f0f6ff;
        }

        .nb-item:hover {
            background: #edf4ff;
        }

        .nb-item-icon {
            background: #e8efff;
            border-radius: 9px;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 17px;
        }

        .nb-text {
            flex: 1;
            min-width: 0;
        }

        .nb-text strong {
            display: block;
            font-size: 12px;
            margin-bottom: 6px;
            color: #172b4d;
        }

        .nb-text p {
            color: #475569;
            font-size: 11px;
            line-height: 1.6;
            margin: 0 0 7px;
            overflow-wrap: anywhere;
        }

        .nb-text small {
            color: #64748b;
            font-size: 10px;
        }

        .nb-empty {
            padding: 28px 15px;
            text-align: center;
            color: #64748b;
            font-size: 12px;
        }

        .nb-footer {
            display: block;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            text-decoration: none !important;
            color: #315b89 !important;
            background: #f8fafc;
        }

        .nb-list form {
            margin: 0;
        }

        @media(max-width:600px) {
            .nb-dropdown {
                position: fixed;
                left: 18px;
                right: 18px;
                top: 135px;
                width: auto;
                max-width: none;
            }
        }
    </style>

    <details class="nb-wrapper" id="notificationBell">

        <summary class="nb-bell"
                 aria-label="Njoftimet"
                 title="Njoftimet">

            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 stroke-linecap="round"
                 stroke-linejoin="round">

                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>

                <path d="M10 21h4"/>

            </svg>

            @if($bellCount > 0)

                <span class="nb-count">

                {{ $bellCount > 99 ? '99+' : $bellCount }}

            </span>

            @endif

        </summary>

        <div class="nb-dropdown">

            <div class="nb-header">

                <strong>Njoftimet</strong>

                <small>

                    {{ $bellCount }} te palexuara

                </small>

            </div>

            <div class="nb-list">

                @forelse($bellItems as $bellItem)

                    @php
                        $bellData = $bellItem->data;

                        $bellType = $bellData['lloji']
                            ?? 'informacion';
                    @endphp

                    <form method="POST"
                          action="{{ route(
                          'njoftimet.hap',
                          $bellItem->id
                      ) }}">

                        @csrf

                        <button type="submit"
                                class="nb-item {{ !$bellItem->read_at ? 'unread' : '' }}">

                            <div class="nb-item-icon">

                                {{ $bellIcons[$bellType] ?? '🔔' }}

                            </div>

                            <div class="nb-text">

                                <strong>

                                    {{ $bellData['titulli'] ?? 'Njoftim' }}

                                </strong>

                                <p>

                                    {{ \Illuminate\Support\Str::limit(
                                        $bellData['mesazhi'] ?? '',
                                        110
                                    ) }}

                                </p>

                                <small>

                                    {{ $bellItem->created_at->format('d.m.Y H:i') }}

                                </small>

                            </div>

                        </button>

                    </form>

                @empty

                    <div class="nb-empty">

                        Nuk ke njoftime te reja.

                    </div>

                @endforelse

            </div>

            <a href="{{ route('njoftimet.index') }}"
               class="nb-footer">

                Shiko te gjitha njoftimet →

            </a>

        </div>

    </details>

    <script>
        document.addEventListener('click', function (event) {

            const bell = document.getElementById(
                'notificationBell'
            );

            if (bell && !bell.contains(event.target)) {

                bell.removeAttribute('open');

            }

        });

        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {

                document.getElementById(
                    'notificationBell'
                )?.removeAttribute('open');

            }

        });
    </script>

@endauth
