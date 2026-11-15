@extends('layouts.club')

@section('title', 'Kalendari - KV Gjinoci')

@section('content')

    <style>
        .kc-page {
            max-width: 1300px;
            margin: 20px auto 40px;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .kc-page * {
            box-sizing: border-box;
        }

        .kc-hero {
            background: linear-gradient(120deg,#172b4d,#315b89);
            color: white;
            padding: 32px;
            border-radius: 20px;
            margin-bottom: 24px;
        }

        .kc-hero small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1.5px;
            font-weight: bold;
        }

        .kc-hero h1 {
            color: white !important;
            font-size: 32px;
            margin: 14px 0;
        }

        .kc-hero p {
            color: #dbeafe;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .kc-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 24px;
            box-shadow: 0 4px 15px rgba(15,23,42,.04);
        }

        .kc-card h2 {
            font-size: 21px;
            margin: 0 0 12px;
        }

        .kc-subtitle {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .kc-filters {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 18px;
            align-items: end;
        }

        .kc-field label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .kc-field select {
            width: 100%;
            min-height: 44px;
            padding: 12px;
            background: #f8fafc;
            color: #172b4d;
            border: 1px solid #dbe3ee;
            border-radius: 9px;
            font-size: 13px;
        }

        .kc-btn {
            background: #253858;
            color: white !important;
            border: none;
            padding: 12px 17px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .kc-btn-light {
            background: #e8efff;
            color: #315b89 !important;
        }

        .kc-btn:hover {
            filter: brightness(.94);
        }

        .kc-legend {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 18px;
            color: #64748b;
            font-size: 12px;
            margin-top: 22px;
        }

        .kc-legend-item {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .kc-dot {
            width: 11px;
            height: 11px;
            border-radius: 3px;
        }

        /* FULLCALENDAR */

        #clubCalendar {
            --fc-border-color: #e2e8f0;
            --fc-button-bg-color: #253858;
            --fc-button-border-color: #253858;
            --fc-button-hover-bg-color: #315b89;
            --fc-button-hover-border-color: #315b89;
            --fc-button-active-bg-color: #172b4d;
            --fc-button-active-border-color: #172b4d;
            --fc-today-bg-color: #eff6ff;
            --fc-page-bg-color: white;
            --fc-neutral-bg-color: #f8fafc;
            font-size: 13px;
        }

        .kc-calendar-wrap {
            overflow-x: auto;
        }

        #clubCalendar {
            min-width: 680px;
        }

        #clubCalendar .fc-toolbar-title {
            font-size: 23px;
            color: #172b4d;
            text-transform: capitalize;
        }

        #clubCalendar .fc-button {
            font-size: 12px;
            font-weight: bold;
            padding: 9px 13px;
            box-shadow: none !important;
        }

        #clubCalendar .fc-col-header-cell {
            padding: 10px 0;
            background: #f8fafc;
        }

        #clubCalendar .fc-col-header-cell-cushion {
            color: #334155;
            text-decoration: none;
        }

        #clubCalendar .fc-daygrid-day-number {
            color: #64748b;
            text-decoration: none;
            padding: 9px;
        }

        #clubCalendar .fc-event {
            border-radius: 5px;
            padding: 3px 5px;
            cursor: pointer;
            font-size: 11px;
        }

        #clubCalendar .fc-event-title {
            font-weight: 600;
        }

        #clubCalendar .fc-daygrid-event {
            margin-top: 4px;
        }

        /* MODAL */

        .kc-modal {
            border: none;
            border-radius: 17px;
            width: 100%;
            max-width: 510px;
            padding: 0;
            color: #172b4d;
            box-shadow: 0 15px 60px rgba(15,23,42,.25);
        }

        .kc-modal::backdrop {
            background: rgba(15,23,42,.55);
        }

        .kc-modal-header {
            background: linear-gradient(120deg,#172b4d,#315b89);
            color: white;
            padding: 24px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .kc-modal-header small {
            color: #bfdbfe;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .kc-modal-header h2 {
            color: white !important;
            font-size: 21px;
            line-height: 1.5;
            margin: 10px 0 0;
        }

        .kc-close {
            background: rgba(255,255,255,.15);
            color: white;
            border: none;
            width: 33px;
            height: 33px;
            border-radius: 8px;
            font-size: 20px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .kc-modal-body {
            padding: 25px;
        }

        .kc-detail {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        .kc-detail span {
            color: #64748b;
        }

        .kc-detail strong {
            text-align: right;
            overflow-wrap: anywhere;
        }

        .kc-result {
            background: #edf4ff;
            color: #315b89;
            padding: 18px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
        }

        .kc-result strong {
            display: block;
            font-size: 32px;
            margin-top: 9px;
        }

        .kc-description {
            background: #f8fafc;
            padding: 15px;
            border-radius: 9px;
            font-size: 13px;
            line-height: 1.7;
            margin-top: 16px;
            white-space: pre-wrap;
        }

        .kc-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 22px;
        }

        .kc-page [hidden],
        .kc-modal [hidden] {
            display: none !important;
        }

        .kc-error {
            background: #fff1f2;
            color: #be123c;
            padding: 15px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .kc-loading {
            color: #64748b;
            text-align: center;
            font-size: 13px;
            padding: 12px;
        }

        @media(max-width:700px) {

            .kc-filters {
                grid-template-columns: 1fr;
            }

            .kc-card,
            .kc-hero {
                padding: 20px;
            }

            .kc-hero h1 {
                font-size: 25px;
            }

            .kc-modal {
                max-width: calc(100vw - 30px);
            }

            #clubCalendar .fc-toolbar-title {
                font-size: 18px;
            }

        }
    </style>

    <div class="kc-page">

        {{-- HERO --}}

        <div class="kc-hero">

            <small>KV GJINOCI | CLUB CALENDAR</small>

            <h1>Kalendari i Klubit</h1>

            <p>
                Percjell ndeshjet, stervitjet dhe aktivitetet
                sportive nga nje kalendar interaktiv.
            </p>

        </div>

        {{-- FILTERS --}}

        <div class="kc-card">

            <h2>Filtro Aktivitetet</h2>

            <p class="kc-subtitle">
                Zgjedh ekipin dhe llojin e aktivitetit.
            </p>

            <div class="kc-filters">

                <div class="kc-field">

                    <label for="calendarTeam">Ekipi</label>

                    <select id="calendarTeam">

                        <option value="">
                            Te gjitha ekipet e lejuara
                        </option>

                        @foreach($ekipet as $ekipi)

                            <option value="{{ $ekipi->id }}">

                                {{ $ekipi->emri }}

                                @if($ekipi->kategoria)

                                    ({{ $ekipi->kategoria }})

                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="kc-field">

                    <label for="calendarType">
                        Lloji i Aktivitetit
                    </label>

                    <select id="calendarType">

                        <option value="all">
                            Te gjitha aktivitetet
                        </option>

                        <option value="ndeshje">
                            Vetem ndeshjet
                        </option>

                        <option value="stervitje">
                            Vetem stervitjet
                        </option>

                    </select>

                </div>

                <button type="button"
                        class="kc-btn kc-btn-light"
                        id="resetCalendar">

                    Pastro Filtrat

                </button>

            </div>

            <div class="kc-legend">

            <span class="kc-legend-item">

                <span class="kc-dot"
                      style="background:#3b82f6;"></span>

                Ndeshje

            </span>

                <span class="kc-legend-item">

                <span class="kc-dot"
                      style="background:#16a34a;"></span>

                Stervitje

            </span>

                <span class="kc-legend-item">

                <span class="kc-dot"
                      style="background:#1e40af;"></span>

                Ndeshje e perfunduar

            </span>

                <span class="kc-legend-item">

                <span class="kc-dot"
                      style="background:#166534;"></span>

                Stervitje e perfunduar

            </span>

                <span class="kc-legend-item">

                <span class="kc-dot"
                      style="background:#dc2626;"></span>

                Aktivitet i anuluar

            </span>

            </div>

        </div>

        {{-- CALENDAR --}}

        <div class="kc-card">

            @if($ekipet->isEmpty())

                <div class="kc-error">
                    Nuk ke ende nje ekip te caktuar.
                    Kontakto administratorin.
                </div>

            @endif

            <div class="kc-error"
                 id="calendarError"
                 hidden>

                Nuk u ngarkuan aktivitetet.
                Provo perseri ose ringarko faqen.

            </div>

            <div class="kc-loading"
                 id="calendarLoading"
                 hidden>

                Duke ngarkuar aktivitetet...

            </div>

            <div class="kc-calendar-wrap">

                <div id="clubCalendar"></div>

            </div>

        </div>

        <p style="text-align:center;color:#64748b;font-size:12px;">

            KV Gjinoci | Club Calendar

        </p>

    </div>

    {{-- EVENT DETAILS MODAL --}}

    <dialog id="eventModal" class="kc-modal">

        <div class="kc-modal-header">

            <div>

                <small id="modalType">AKTIVITET</small>

                <h2 id="modalTitle">Detajet</h2>

            </div>

            <button type="button"
                    class="kc-close"
                    id="closeEventModal"
                    aria-label="Mbylle">

                ×

            </button>

        </div>

        <div class="kc-modal-body">

            <div class="kc-detail">
                <span>Ekipi</span>
                <strong id="modalTeam">-</strong>
            </div>

            <div class="kc-detail">
                <span>Data</span>
                <strong id="modalDate">-</strong>
            </div>

            <div class="kc-detail">
                <span>Ora</span>
                <strong id="modalTime">-</strong>
            </div>

            <div class="kc-detail">
                <span>Palestra</span>
                <strong id="modalVenue">-</strong>
            </div>

            <div class="kc-detail">
                <span>Statusi</span>
                <strong id="modalStatus">-</strong>
            </div>

            <div class="kc-detail"
                 id="modalLocationRow"
                 hidden>

                <span>Lokacioni</span>

                <strong id="modalLocation">-</strong>

            </div>

            <div class="kc-result"
                 id="modalResultBox"
                 hidden>

                <small>REZULTATI FINAL</small>

                <strong id="modalResult">-</strong>

            </div>

            <div class="kc-description"
                 id="modalDescription"
                 hidden>
            </div>

            <div class="kc-modal-actions">

                <button type="button"
                        id="cancelEventModal"
                        class="kc-btn kc-btn-light">

                    Mbylle

                </button>

                <a href="#"
                   id="modalEdit"
                   class="kc-btn"
                   hidden>

                    Edito Aktivitetin

                </a>

            </div>

        </div>

    </dialog>

    {{-- FULLCALENDAR LIBRARY --}}

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.22/index.global.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.22/locales-all.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const calendarEl = document.getElementById('clubCalendar');

            const team = document.getElementById('calendarTeam');

            const type = document.getElementById('calendarType');

            const reset = document.getElementById('resetCalendar');

            const loading = document.getElementById('calendarLoading');

            const error = document.getElementById('calendarError');

            const modal = document.getElementById('eventModal');

            if (typeof FullCalendar === 'undefined') {

                error.textContent =
                    'FullCalendar nuk u ngarkua. Kontrollo internetin.';

                error.hidden = false;

                return;

            }

            function setText(id, value) {

                document.getElementById(id).textContent =
                    value || '-';

            }

            function hapDetajet(event) {

                const data = event.extendedProps;

                setText(
                    'modalType',
                    data.lloji?.toUpperCase()
                );

                setText('modalTitle', event.title);

                setText('modalTeam', data.ekipi);

                setText('modalDate', data.data);

                setText('modalTime', data.ora);

                setText('modalVenue', data.palestra);

                setText('modalStatus', data.statusi);

                const locationRow =
                    document.getElementById('modalLocationRow');

                locationRow.hidden = !data.lokacioni;

                setText('modalLocation', data.lokacioni);

                const resultBox =
                    document.getElementById('modalResultBox');

                resultBox.hidden = !data.rezultati;

                setText('modalResult', data.rezultati);

                const description =
                    document.getElementById('modalDescription');

                description.textContent =
                    data.pershkrimi || '';

                description.hidden = !data.pershkrimi;

                const editButton =
                    document.getElementById('modalEdit');

                editButton.hidden = !data.editUrl;

                if (data.editUrl) {

                    editButton.href = data.editUrl;

                } else {

                    editButton.removeAttribute('href');

                }

                modal.showModal();

            }

            const calendar = new FullCalendar.Calendar(
                calendarEl,
                {

                    initialView: 'dayGridMonth',

                    locale: 'sq',

                    timeZone: 'local',

                    firstDay: 1,

                    height: 'auto',

                    dayMaxEvents: true,

                    editable: false,

                    selectable: false,

                    nowIndicator: true,

                    headerToolbar: {

                        left: 'prev,next today',

                        center: 'title',

                        right:
                            'dayGridMonth,timeGridWeek,timeGridDay,listWeek'

                    },

                    buttonText: {

                        today: 'Sot',

                        month: 'Muaji',

                        week: 'Java',

                        day: 'Dita',

                        list: 'Lista'

                    },

                    allDayText: 'Gjithe dita',

                    noEventsText: 'Nuk ka aktivitete.',

                    moreLinkText: function (num) {

                        return '+' + num + ' tjera';

                    },

                    eventTimeFormat: {

                        hour: '2-digit',

                        minute: '2-digit',

                        hour12: false

                    },

                    slotLabelFormat: {

                        hour: '2-digit',

                        minute: '2-digit',

                        hour12: false

                    },

                    slotMinTime: '07:00:00',

                    slotMaxTime: '24:00:00',

                    scrollTime: '08:00:00',

                    events: {

                        url: @json(route('kalendari.events')),

                        method: 'GET',

                        extraParams: function () {

                            return {

                                ekipi_id: team.value,

                                lloji: type.value

                            };

                        },

                        failure: function () {

                            error.hidden = false;

                        }

                    },

                    loading: function (isLoading) {

                        loading.hidden = !isLoading;

                        if (isLoading) {

                            error.hidden = true;

                        }

                    },

                    eventClick: function (info) {

                        info.jsEvent.preventDefault();

                        hapDetajet(info.event);

                    }

                }
            );

            calendar.render();

            team.addEventListener('change', function () {

                calendar.refetchEvents();

            });

            type.addEventListener('change', function () {

                calendar.refetchEvents();

            });

            reset.addEventListener('click', function () {

                team.value = '';

                type.value = 'all';

                calendar.today();

                calendar.refetchEvents();

            });

            document.getElementById('closeEventModal')
                .addEventListener('click', function () {

                    modal.close();

                });

            document.getElementById('cancelEventModal')
                .addEventListener('click', function () {

                    modal.close();

                });

            modal.addEventListener('click', function (event) {

                if (event.target === modal) {

                    modal.close();

                }

            });

        });
    </script>

@endsection
