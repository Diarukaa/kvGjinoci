@extends('layouts.club')

@section('title', 'Edito Menaxherin')

@section('content')

    <div class="card">

        <h1>Edito Menaxherin</h1>

        <form method="POST"
              action="{{ route('managers.update', $manager) }}">

            @csrf
            @method('PUT')

            @include('managers.form')

        </form>

    </div>

    <a class="btn"
       href="{{ route('managers.index') }}">
        Kthehu te Lista
    </a>

@endsection
