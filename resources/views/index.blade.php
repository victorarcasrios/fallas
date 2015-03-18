@extends('layouts.main')

@section('content')
<div class="panel panel-danger">
	<div class="panel-heading">		
		<h4 class="panel-title">
			<i class="glyphicon glyphicon-fire"></i>
			Las Fallas más Molestas e Irrespetuosas
		</h4>
	</div>
	<div class="panel-body">
		<!-- <div class="row">
			<div class="col-lg-12">
				<div class="input-group pull-right">
					<label for="recordsNumber">Nº registros a mostrar</label>
					<select id="recordsNumber" class="form-control">
						<option value="5">5</option>
						<option value="15" selected>15</option>
						<option value="30">30</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
				</div>
			</div>
			<div class="col-lg-12"><hr></div>
		</div> -->
		@if( count($fallas) > 0 )
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
		@else
		<div class="alert alert-info row">
			<h3 style="text-align: center">
				<small>No hay quejas.</small> ¡Sé el primero en ponerlos a caldo!
			</h3>
			<a href="/objections/form" class="btn btn-danger pull-right">
				<i class="glyphicon glyphicon-fire"></i>
				Quéjate
			</a>
		</div>
		@endif
	</div>
</div>
@stop

@section('additionalJavaScript')
<!-- Main JavaScript -->
<script src="{{ URL::asset('js/index.js') }}"></script>
@stop

