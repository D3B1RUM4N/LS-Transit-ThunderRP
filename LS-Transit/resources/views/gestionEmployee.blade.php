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


    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h2, h3 {
    color: #333;
    margin-bottom: 10px;
}

form {
    margin-top: 20px;
    max-width: 400px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"], input[type="checkbox"] {
    margin-bottom: 10px;
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

input[type="checkbox"] {
    margin-left: 4px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

table {
    margin-top: 20px;
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #4caf50;
    color: white;
}

tbody tr:hover {
    background-color: #f5f5f5;
}
    </style>
@endsection