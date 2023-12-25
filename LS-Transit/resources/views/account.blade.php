@extends('layouts.mainLayout')

@section('title','Account')

@section('content')
	<p>
		Bonjour {{ session('user')->login }} !<br>
		Bienvenu sur ton compte.
	</p>
	<p><a href="signout">Sign out</a></p>
@endsection