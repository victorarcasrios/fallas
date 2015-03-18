@extends('layouts.main')

@section('content')

<div class="row-fluid">
	<div class="col-lg-12">
		<br>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">Nueva Falla</h4>
	</div>
	<div class="panel-body">
		<form action="/fallas" method="POST">
			<div class="row-fluid">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="col-lg-12">
					<br>
				</div>
				<div class="col-lg-5">
					<div class="input-group">
						<input type="text" name="name" class="form-control" placeholder="Nombre">
						<div class="input-group-addon"><i class="glyphicon glyphicon-fire"></i></div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="input-group">
						<input type="text" name="address" class="form-control" placeholder="Dirección">
						<div class="input-group-addon"><i class="glyphicon glyphicon-road"></i></div>
					</div>
				</div>
				<div class="col-lg-12">
					<hr>
				</div>
				<div class="col-lg-12">
					<input type="submit" name="submit" value="Crear" class="btn btn-success center-block">
				</div>
			</div>
		</form>
	</div>	
</div>

@stop