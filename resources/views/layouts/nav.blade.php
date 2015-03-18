<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li><a href="/fallas/top">TOP Fallas</a></li>
			<li><a href="/fallas/search">Busqueda de Fallas</a></li>
			<li><a href="/objections">Quéjas</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			@if( Auth::check() )
			<li><a href="/users/exit">Cerrar sesión</a></li>
			@else
			<li><a href="/users/access">Acceder</a></li>
			<li><a href="/users">Registrarse</a></li>
			@endif
		</ul>
	</div>
</nav>