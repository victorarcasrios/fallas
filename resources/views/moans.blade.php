@extends('layouts.main')

@section('content')
<div class="panel panel-warning">
	<div class="panel-heading">		
		<h4 class="panel-title">
			<i class="glyphicon glyphicon-tags"></i>
			Quéjas de usuarios
		</h4>
	</div>
	<div class="panel-body">
		<div class="row-fluid">
			@if( count($moans) === 0 )
			<div class="alert alert-info">
				<h3 style="text-align: center">
					<small>No hay quejas.</small> ¡Sé el primero en ponerlos a caldo!
				</h3>
			</div>
			@endif
			<a href="/objections/form" class="btn btn-danger pull-right">
				<i class="glyphicon glyphicon-fire"></i>
				Quéjate
			</a>
		</div>
		<div class="container-fluid">
			@if( count($moans) > 0 )
				@foreach($moans as $key => $moan)
				<div class="col-lg-4">
					<div class="well">
						<h4 style="color: cornflowerblue;">
							{{ $moan->falla }} 
							<small class="pull-right">
							{{ date_format(date_create_from_format('Y-m-d H:i:s', $moan->created_at), 'H:i:s d-m-Y') }}
							</small>
						</h4>
						<p>{{ $moan->text }}</p>
						<p style="text-align: right"><b><i> -- {{ $moan->author }} -- </i></b></p>
					</div>
				</div>
				@endforeach
			@endif
		</div>
	</div>
</div>
@stop