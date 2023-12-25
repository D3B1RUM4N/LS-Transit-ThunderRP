@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Nouvelle Facture</h2>
    <form action="" method="post">
        @csrf
        <label for="client">Client : </label>
        <input type="text" id="client" required><br>
        <label for="kilometrique">Kilometrique : </label>
        <input type="number" id="kilometrique" required oninput="calculateAmount()"><br>
        <label for="vehicule">Vehicule : </label>
        <select id="vehicule" onchange="calculateAmount()">
            @foreach ($vehicules as $vehicule)
                <option value="{{ $vehicule->tarif }}">{{ $vehicule->vehicule }}</option>
            @endforeach
        </select><br>
        <label for="montant">Montant : </label>
        <input type="number" id="montant" name="montant"><br>
        <label for="dateFacture">Date de la facture : </label>
        <input type="date" id="dateFacture" required><br>
    </form>
    <h2>Rappel des tarifs</h2>
    @foreach ($vehicules as $vehicule)
        <p>{{ $vehicule->vehicule }} : {{ $vehicule->tarif }}</p>
    @endforeach

    <script>
        function calculateAmount() {
            let kilometrique = document.getElementById('kilometrique').value;
            let vehicule = document.getElementById('vehicule').value;
            let montant = kilometrique * vehicule;

            // Mettre à jour la valeur du champ Montant
            document.getElementById('montant').value = montant.toFixed(2);
        }
    </script>
@endsection