<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>Edit Trajner</title>
</head>
<body>

<h1>Ndrysho te Dhenat e Trajnerit</h1>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('trajner.update', $trajner) }}"
      method="POST">

    @csrf
    @method('PUT')

    <label>Emri:</label>
    <input type="text" name="emri"
           value="{{ old('emri', $trajner->emri) }}" required>
    <br><br>

    <label>Mbiemri:</label>
    <input type="text" name="mbiemri"
           value="{{ old('mbiemri', $trajner->mbiemri) }}" required>
    <br><br>

    <label>Email:</label>
    <input type="email" name="email"
           value="{{ old('email', $trajner->email) }}" required>
    <br><br>

    <label>Data e Lindjes:</label>
    <input type="date" name="dataELindjes"
           value="{{ old('dataELindjes', $trajner->dataELindjes) }}"
           required>
    <br><br>

    <label>Numri i Telefonit:</label>
    <input type="number" name="nrTelefonit"
           value="{{ old('nrTelefonit', $trajner->nrTelefonit) }}"
           required>
    <br><br>

    <label>Vendbanimi:</label>
    <input type="text" name="vendbanimi"
           value="{{ old('vendbanimi', $trajner->vendbanimi) }}"
           required>
    <br><br>

    <label>IBAN:</label>
    <input type="text"
           name="IBAN"
           value="{{ old('IBAN', $trajner->IBAN) }}"
           maxlength="34"
           required>
    <br><br>

    <button type="submit">Ruaj Ndryshimet</button>
</form>

<br>
<a href="{{ route('trajner.index') }}">Kthehu</a>

</body>
</html>
