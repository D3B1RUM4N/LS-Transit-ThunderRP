@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Liste des factures</h2>
    <table class="facture-table">
        <thead>
            <tr>
                <th>Employé</th>
                <th>Client</th>
                <th>Kilométrique</th>
                <th>Véhicule</th>
                <th>Montant</th>
                <th>Date de la facture</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factures as $facture)
                <tr>
                    <td>{{ $facture->emp }}</td>
                    <td>{{ $facture->client }}</td>
                    <td>{{ $facture->kilometrique }}</td>
                    <td>{{ $facture->vehicule }}</td>
                    <td>{{ $facture->montant }}</td>
                    <td>{{ $facture->dateFacture }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
