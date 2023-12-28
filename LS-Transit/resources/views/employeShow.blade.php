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
    <h3>Voir l'historique des primes : </h3>

    <h3>Supprimer l'employé : </h3>
    <form action="{{route('user_deleteuser')}}" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $employe->id }}">
        <input type="submit" value="Supprimer">
    </form>

    
@endsection