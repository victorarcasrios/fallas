@extends('layouts.main')

@section('content')
<div class="row-fluid">
	<div class="col-lg-12">
		<br>
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">Buscador de Fallas</h4>
	</div>
	<div class="panel-body">
		<form action="/fallas/search" method="POST">
			<div class="row-fluid">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="col-lg-12">
					<br>
				</div>
				<div class="col-lg-4">
					<div class="input-group">
						<input type="text" name="name" placeholder="Nombre de la Falla" class="form-control">
						<div class="input-group-addon"><i class="glyphicon glyphicon-fire"></i></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="input-group">
						<input type="text" name="address" placeholder="Dirección" class="form-control">
						<div class="input-group-addon"><i class="glyphicon glyphicon-road"></i></div>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="input-group">
						<button type="submit" name="submit"class="btn btn-info center-block">
							Buscar
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>	
</div>

@if( isset($fallas) )
<div class="panel panel-warning">
	<div class="panel-heading">		
		<h4 class="panel-title">
			<i class="glyphicon glyphicon-fire"></i>
			Fallas encontradas
		</h4>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Puesto</th>
					<th><center>Nombre</center></th>
					<th><center>Dirección</center></th>
					<th><center>Nº de Quejas</center></th>
					<th><center>Quéjate</center></th>
				</tr>
			</thead>
			<tbody>
				@foreach($fallas as $num => $falla)

				<tr>
					<th>#{{ ($num+1) }}</th>
					<td><center>{{ $falla->name }}</center></td>
					<td><center>{{ $falla->address }}</center></td>
					<td><center>{{ $falla->score }}</center></td>
					<td>
						<center>
							<a href="/fallas/{{ $falla->id }}/objections/form" class="btn btn-danger">
								<i class="glyphicon glyphicon-thumbs-down"></i>
							</a>
						</center>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@else
<div class="row-fluid">
	<div class="alert alert-warning" style="text-align: center;">
		¿No encuentras la falla que te saca de quicio?
		<a href="/fallas" class="btn btn-success">Creala tú</a>
	</div>
</div>

@endif

@stop