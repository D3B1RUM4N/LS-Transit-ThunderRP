@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Gestion des tarifs</h2>
    <h3>Ajouter un tarif</h3>
    <form action="{{ route('tarif_addtarif') }}" method="post">
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
                        <form action="{{ route('tarif_changetarif') }}" method="post">
                            @csrf
                            <input type="hidden" id="vehicule" name="vehicule" value="{{ $tarif->vehicule }}">
                            <input type="number" id="tarif" name="tarif" value="{{ $tarif->tarif }}" required>
                            <button type="submit" name="action" value="modifier">Modifier</button>
                        </form>

                        <form action="{{ route('tarif_deletetarif') }}" method="post">
                            @csrf
                            <input type="hidden" id="vehicule" name="vehicule" value="{{ $tarif->vehicule }}">
                            <button type="submit" name="action" value="supprimer">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection