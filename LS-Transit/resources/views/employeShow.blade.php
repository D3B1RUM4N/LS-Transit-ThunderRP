@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>{{$employe->login}}</h2>
    <h3>Modifier les infos : </h3>
    <form action="{{route('user_changeuser')}}" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $employe->id }}">
        <label for="login">Login : </label>
        <input type="text" id="login" name="login" value="{{ $employe->login }}" required><br>
        <label for="grade">Grade : </label>
        <select id="grade" name="grade">
            @foreach ($grades as $grade)
                <option value="{{ $grade->id }}" @if($employe->grade == $grade->id) selected @endif>{{ $grade->label }}</option>
            @endforeach
        </select></br>
        <label for="admin">Admin : </label>
        <input type="checkbox" id="admin" name="admin" value="admin" @if($employe->admin) checked @endif><br>
        <input type="submit" value="Modifier">
    </form>
    <h3> Historique des factures : </h3>
    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Kilométrique</th>
                <th>Tarif</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employe->factures as $facture)
                <tr>
                    <td>{{ $facture->client }}</td>
                    <td>{{ $facture->kilometrique }}</td>
                    <td>{{ $facture->tarif }}</td>
                    <td>{{ $facture->montant }}</td>
                    <td>{{ $facture->dateFacture }}</td>
                </tr>
            @endforeach
    </table>
    <h3>Gestion des primes : </h3>
    <h4>Nouvelle prime : </h4>
    <h4>Nouvelle prime : </h4>
    <form action="{{ route('prime_add') }}" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $employe->id }}">
        <label for="montant">Montant : </label>
        <input type="number" id="montant" name="montant" value="{{ $employe->montant * $employe->part / 100 }}" required><br>
        <label for="date">Date : </label>
        <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" required><br>
        <input type="submit" value="Ajouter">
    </form>

    <h4>Historique des primes : </h4>
    <table>
        <thead>
            <tr>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employe->paies as $paie)
                <tr>
                    <td>{{ $paie->montant }}</td>
                    <td>{{ $paie->datePaie }}</td>
                </tr>
            @endforeach
    </table>

    <h3>Supprimer l'employé : </h3>
    <form action="{{route('user_deleteuser')}}" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $employe->id }}">
        <input type="submit" value="Supprimer">
    </form>
    
@endsection