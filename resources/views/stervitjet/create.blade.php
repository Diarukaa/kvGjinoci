@extends('layouts.club')

@section('title', 'Shto Stervitje')

@section('content')

    <div class="card">

        <h1>Shto Stervitje te Re</h1>

        <form method="POST"
              action="{{ route('stervitjet.store') }}">

            @csrf

            @include('stervitjet.form')

        </form>

    </div>

    <a class="btn"
       href="{{ route('stervitjet.index') }}">
        Kthehu te Stervitjet
    </a>

@endsection
