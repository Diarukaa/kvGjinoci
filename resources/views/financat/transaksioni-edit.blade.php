@extends('layouts.club')

@section('title', 'Edito Transaksionin - KV Gjinoci')

@section('content')

    @include('financat.transaksioni-style')

    <div class="tf-page" style="max-width:950px;">

        <div class="tf-hero">

            <small>KV GJINOCI | FINANCE CENTER</small>

            <h1>Edito Transaksionin</h1>

            <p>

                {{ $transaksioni->pershkrimi }}

                |

                {{ number_format($transaksioni->shuma, 2) }} €

            </p>

        </div>

        @if($errors->any())

            <div class="tf-message tf-error">

                @foreach($errors->all() as $error)

                    <div>{{ $error }}</div>

                @endforeach

            </div>

        @endif

        <div class="tf-card">

            <h2>Te Dhenat e Transaksionit</h2>

            <p class="tf-subtitle">

                Ndrysho informacionet dhe ruaj
                transaksionin financiar.

            </p>

            @include('financat.transaksioni-form')

        </div>

    </div>

@endsection
