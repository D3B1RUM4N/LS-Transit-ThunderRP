@extends('layouts.mainLayout')

@section('title','Account')

@section('content')
@if($user = session('user')) @endif
    <h1>Bienvenue {{ $user->login }}</h1>
    <div class="container">
        <div class="panel">
            <div class="panel-item">
                <h4>Distance parcourue :</h4>
                <p>{{ $user->km }} km</p>
            </div>
            <div class="panel-item">
                <h4>Total des factures :</h4>
                <p>{{ $user->montant }} $</p>
            </div>
            <div class="panel-item">
                <h4>Gestion du compte :</h4>
                <p><a href="changeuser">Changer le mot de passe</a></p>
            </div>
        </div>
    </div>
    <p><a href="signout">Se deconnecter</a></p>
@endsection

<style>
.panel {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.panel-item {
    flex: 0 0 calc(33.3333% - 20px); /* Trois éléments par ligne avec un espace de 20px entre eux */
    margin-bottom: 20px;
    background-color: #fff;
    padding: 15px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #333;
}

h4 {
    color: #555;
    margin-bottom: 10px;
}

p {
    margin: 0;
    color: #333;
}

a {
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

</style>