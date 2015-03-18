@extends('layouts.main')

@section('content')

<div class="row-fluid">
	<div class="col-lg-12">
		<br>
	</div>
</div>

<div class="panel panel-success">
	<div class="panel-heading">
		<h4 class="panel-title">Acceso</h4>
	</div>
	<div class="panel-body">
		<form action="/users/access" method="POST">
			<div class="row-fluid">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="col-lg-12">
					<br>
				</div>
				<div class="col-lg-4 col-lg-offset-4">
					<div class="input-group">
						<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
						<input type="text" name="nameOrEmail" placeholder="Usuario o email" class="form-control" required>
						<div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
					</div>
				</div>
				<div class="col-lg-4 col-lg-offset-4">
					<br>
				</div>
				<div class="col-lg-4 col-lg-offset-4">
					<div class="input-group">
						<input type="password" name="password" placeholder="Contraseña" class="form-control" required>
						<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
					</div>
				</div>
				<div class="col-lg-4 col-lg-offset-4">
					<hr>
				</div>
				<div class="col-lg-12">
					<input type="submit" name="submit" value="Acceder a mi cuenta" class="btn btn-success center-block">
				</div>
			</div>
		</form>
	</div>	
</div>

@stop