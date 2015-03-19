@extends('layouts.main')

@section('content')

<div class="row-fluid">
	<div class="col-lg-12">
		<br>
	</div>
</div>

@if( $errors->any() )
<div class="row">
	<class class="col-lg-10 col-lg-offset-1 alert alert-danger alert alert-danger">
		<p><b>¡Atención!</b> Se han producido los siguientes errores de validación:</p>
		<ul>
			@foreach( $errors->all() as $error )
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</class>
</div>

<div class="row-fluid">
	<class class="col-lg-12">
		<br>
	</class>
</div>
@endif

<div class="panel panel-success">
	<div class="panel-heading">
		<h4 class="panel-title">Registro</h4>
	</div>
	<div class="panel-body">
		<form action="/users" method="POST">
			<div class="row-fluid">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="col-lg-12">
					<br>
				</div>
				<div class="col-lg-6">
					<div class="input-group">
						<div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
						<input type="text" name="name" placeholder="Tu nombre" class="form-control" required>
					</div>
				</div>
				@if( isset($errors->messages->name) )
				<div class="col-lg-6">
					<div class="alert alert-danger">{{ $errors->messages->name }}</div>
				</div>
				@endif
				<div class="col-lg-6">
					<div class="input-group">
						<input type="email" name="email" placeholder="Tu email" class="form-control" required>
						<div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
					</div>
				</div>
				@if( isset($errors->messages->email) )
				<div class="col-lg-6">
					<div class="alert alert-danger">{{ $errors->messages->email }}</div>
				</div>
				@endif
				<div class="col-lg-12">
					<hr>
				</div>
				<div class="col-lg-6">
					<div class="input-group">
						<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
						<input type="password" name="password" placeholder="Contraseña" class="form-control" required>
					</div>
				</div>
				@if( isset($errors->messages->password) )
				<div class="col-lg-6">
					<div class="alert alert-danger">{{ $errors->messages->password }}</div>
				</div>
				@endif
				<div class="col-lg-6">
					<div class="input-group">
						<input type="password" name="repeatPassword" placeholder="Repite la contraseña" class="form-control" required>
						<div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
					</div>
				</div>
				<div class="col-lg-12">
					<hr>
				</div>
				<div class="col-lg-12">
					<input type="submit" name="submit" value="Registrarme" class="btn btn-success center-block">
				</div>
			</div>
		</form>
	</div>	
</div>

@stop