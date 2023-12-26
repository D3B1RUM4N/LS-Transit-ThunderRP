<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
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
				@endif
			</ul>
		</nav>
		@section('content')
		@show

		@include('shared.message')
	</body>
</html>
