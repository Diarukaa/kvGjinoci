@extends('layouts.club')

@section('title', 'Edito Stervitjen')

@section('content')

    <div class="card">

        <h1>Edito Stervitjen</h1>

        <form method="POST"
              action="{{ route('stervitjet.update', $stervitja) }}">

            @csrf
            @method('PUT')

            @include('stervitjet.form')

        </form>

    </div>

    <a class="btn"
       href="{{ route('stervitjet.index') }}">
        Kthehu te Stervitjet
    </a>

@endsection
