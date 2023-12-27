@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Gestion des tarifs</h2>
    <h3>Ajouter un tarif</h3>
    <form action="{{ route('tarif_add') }}" method="post">
        @csrf
        <label for="vehicule">Vehicule</label>      <input type="text"     id="vehicule"    name="vehicule"    required autofocus><br>
        <label for="tarif">Tarif</label><input type="number" id="tarif" name="tarif" required> <br>
        <input type="submit" value="Ajouter">
    </form>
    <h3>Liste des tarifs</h3>
    <table>
        <thead>
            <tr>
                <th>Vehicule</th>
                <th>tarif au km</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarifs as $tarif)
                <tr>
                    <td>{{ $tarif->vehicule }}</td>
                    <td>
                        <form action="{{ route('tarif_change') }}" method="post">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $tarif->id }}">
                            <input type="number" id="tarif" name="tarif" value="{{ $tarif->tarif }}" required>
                            <button type="submit" name="action" value="modifier">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('tarif_delete') }}" method="post">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $tarif->id }}">
                            <button type="submit" name="action" value="supprimer">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <style>
/* Ajoutez ceci à votre fichier CSS ou dans la balise <style> de la vue Laravel */

h2 {
    color: #333;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

input[type="submit"],
button {
    background-color: #3498db;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover,
button:hover {
    background-color: #2980b9;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #333;
    color: white;
}

/* Alignez les boutons sous la colonne "Actions" */
td form {
    display: flex;
    flex-direction: column;
}

/* Espacement entre les boutons "Modifier" et "Supprimer" */
td form button {
    margin-top: 5px;
}
    </style>



    
@endsection