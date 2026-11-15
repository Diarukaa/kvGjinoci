@extends('layouts.club')

@section('title', 'Shto Perdorues - KV Gjinoci')

@section('content')

    <div style="max-width:1050px;margin:20px auto 40px;">

        <div style="
        background:linear-gradient(120deg,#172b4d,#315b89);
        color:white;
        border-radius:18px;
        padding:32px;
        margin-bottom:24px;
    ">

            <small style="color:#bfdbfe;letter-spacing:1.5px;">
                KV GJINOCI | USER MANAGEMENT
            </small>

            <h1 style="color:white;margin:14px 0;">
                Shto Perdorues te Ri
            </h1>

            <p style="color:#dbeafe;margin:0;font-size:14px;">
                Krijo llogarine dhe cakto rolin
                dhe profilin perkates.
            </p>

        </div>

        @include('users.form')

    </div>

@endsection
