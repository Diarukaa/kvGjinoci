@extends('layouts.club')

@section('title', 'Profili i Menaxherit')

@section('content')

    <div class="card">

        <h1>Profili i Menaxherit</h1>

        <div style="width:85px;
                height:85px;
                border-radius:50%;
                background:#253858;
                color:white;
                display:flex;
                align-items:center;
                justify-content:center;
                font-size:30px;
                font-weight:bold;">

            {{ mb_substr($manager->emri, 0, 1) }}{{ mb_substr($manager->mbiemri, 0, 1) }}

        </div>

        <h2>
            {{ $manager->emri }}
            {{ $manager->mbiemri }}
        </h2>

        <p style="color:#64748b">
            Stafi Administrativ - KV Gjinoci
        </p>

        <hr>

        <p>
            <strong>ID:</strong>
            {{ $manager->id }}
        </p>

        <p>
            <strong>Email:</strong>
            {{ $manager->email }}
        </p>

        <p>
            <strong>Data e Lindjes:</strong>
            {{ $manager->dataELindjes?->format('d.m.Y') ?? '-' }}
        </p>

        <p>
            <strong>Telefoni:</strong>
            {{ $manager->nrTelefonit }}
        </p>

        <p>
            <strong>Vendbanimi:</strong>
            {{ $manager->vendbanimi }}
        </p>

        <p>
            <strong>Data e Regjistrimit:</strong>
            {{ $manager->created_at?->format('d.m.Y') ?? '-' }}
        </p>

        <hr>

        <div class="actions">

            <a class="btn"
               href="{{ route('managers.edit', $manager) }}">
                Edito Profilin
            </a>

            <a class="btn"
               href="{{ route('managers.index') }}">
                Kthehu te Menaxheret
            </a>

        </div>

    </div>

@endsection
