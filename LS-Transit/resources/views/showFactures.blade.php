@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Liste des factures</h2>
    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Kilometrique</th>
                <th>Tariffication /km</th>
                <th>Montant</th>
                <th>Date de la facture</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factures as $facture)
                <tr>
                    <td>{{ $facture->client }}</td>
                    <td>{{ $facture->kilometrique }}</td>
                    <td>{{ $facture->tarif }}</td>
                    <td>{{ $facture->montant }}</td>
                    <td>{{ $facture->dateFacture }}</td>
                </tr>
            @endforeach
        </tbody>
@endsection