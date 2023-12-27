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
