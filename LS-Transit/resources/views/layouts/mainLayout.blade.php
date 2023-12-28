<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: white;
        }

        .container {
            margin: 20px;
        }

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

        input {
            margin-bottom: 10px;
        }

        input[type="number"], input[type="date"] {
            width: calc(100% - 16px);
            padding: 8px;
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

        select {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        /* Style pour les options du select */
        select option {
            background-color: #fff;
            color: #333;
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
</head>
<body>    
    <nav>
        <ul>
            <li><a href="{{ route('view_account') }}">Home</a></li>
            <li><a href="{{ route('factures_new') }}">Facture</a></li>
            <li><a href="{{ route('factures_list') }}">Liste des factures</a></li>
            <li><a href="{{ route('view_account') }}">Account</a></li>
            @if( session('user')->admin )
                <li><a href="{{ route('employees_list') }}">Gestion des employés</a></li>
                <li><a href="{{ route('gestion_factures_list') }}">Gestion des factures</a></li>
                <li><a href="{{ route('tarifs_list') }}">Gestion des tarifs</a></li>
                <li><a href="{{ route('grades_list') }}">Gestion des grades</a></li>
            @endif
        </ul>
    </nav>
    <div class="container">
        @section('content')
        @show

        @include('shared.message')
    </div>
</body>
</html>
