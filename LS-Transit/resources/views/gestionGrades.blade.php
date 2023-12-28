@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Gestion des grades</h2>
    <h3>Ajouter un grade</h3>
    <form action="{{ route('grade_add') }}" method="post">
        @csrf
        <label for="Label">Label : </label>      <input type="text"     id="label"    name="label"    required autofocus><br>
        <label for="part">part : </label><input type="number" id="part" name="part" required> <br>
        <input type="submit" value="Ajouter">
    </form>
    <h3>Liste des grades</h3>
    <table>
        <thead>
            <tr>
                <th>Label</th>
                <th>part</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->label }}</td>
                    <td>
                        <form action="{{ route('grade_change') }}" method="post">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $grade->id }}">
                            <input type="number" id="part" name="part" value="{{ $grade->part }}" required>
                            <button type="submit" name="action" value="modifier">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('grade_delete') }}" method="post">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $grade->id }}">
                            <button type="submit" name="action" value="supprimer">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection