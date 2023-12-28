@extends('layouts.mainLayout')

@section('title', 'Facture')

@section('content')
    <h2>Gestion des Employés</h2>
    <h3>Ajouter un employé</h3>
    <form action="{{route('user_adduser')}}" method="post">
        @csrf
        <label for="login">Login : </label>
        <input type="text" id="login" name="login" required><br>
        <label for="admin">Admin : </label>
        <input type="checkbox" id="admin" name="admin" value="admin"><br>
        <input type="submit" value="Ajouter">
    </form>

    <h3>Liste des employés</h3>


    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Admin</th>
                <th>Afficher</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employe)
                <tr>
                    <td>{{ $employe->login }}</td>
                    <td>@if($employe->admin) Oui @else Non @endif</td>
                    <td>
                        <form action="{{ route('employees_show') }}" method="post">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $employe->id }}">
                            <input type="submit" value="Afficher">
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection