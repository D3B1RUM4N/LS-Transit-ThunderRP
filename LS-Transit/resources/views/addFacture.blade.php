@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Nouvelle Facture</h2>
    <form action="{{ route('facture_add') }}" method="post">
        @csrf
        <label for="client">Client : </label>
        <input type="text" id="client" name="client" required><br>
        <label for="kilometrique">Kilometrique : </label>
        <input type="number" id="kilometrique" name="kilometrique" required oninput="calculateAmount()"><br>
        <label for="vehicule">Vehicule : </label>
        <select id="tarif" name="tarif" onchange="calculateAmount()">
            @foreach ($vehicules as $vehicule)
                <option value="{{ $vehicule->tarif }}">{{ $vehicule->vehicule }}</option>
            @endforeach
        </select><br>
        <label for="montant">Montant : </label>
        <input type="number" id="montant" name="montant"><br>
        <label for="dateFacture">Date de la facture : </label>
        <input type="date" id="dateFacture" name="dateFacture" required><br>
        <input type="submit" value="Ajouter">
    </form>
    <h2>Rappel des tarifs</h2>
    @foreach ($vehicules as $vehicule)
        <p>{{ $vehicule->vehicule }} : {{ $vehicule->tarif }}</p>
    @endforeach

    <script>
        function calculateAmount() {
            let kilometrique = document.getElementById('kilometrique').value;
            let vehicule = document.getElementById('tarif').value;
            let montant = kilometrique * vehicule;

            // Mettre à jour la valeur du champ Montant
            document.getElementById('montant').value = montant.toFixed(2);
        }
    </script>



    <style>
        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 8px;
        }

        input[type="number"], input[type="date"] {
            width: calc(100% - 16px);
            padding: 8px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 + p {
            margin-top: 10px;
        }
    </style>
@endsection