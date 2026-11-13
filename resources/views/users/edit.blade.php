@extends('layouts.club')

@section('title', 'Edito Perdoruesin - KV Gjinoci')

@section('content')

    @include('users.form', ['user' => $user])

@endsection
