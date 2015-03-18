@extends('layouts.main')

@section('content')

<div class="row-fluid">
	<div class="col-lg-12">
		<br>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">Nueva queja</h4>
	</div>
	<div class="panel-body">
		<form action="/objections" method="POST">
			<div class="row-fluid">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="col-lg-12">
					<br>
				</div>
				<div class="col-lg-5">
					<label for="falla">Falla</label>
					<div class="input-group">
						<div class="input-group-addon"><i class="glyphicon glyphicon-fire"></i></div>
						<select name="falla" class="form-control">
							@foreach($fallas as $falla)
							<option value="{{ $falla->id }}" 
								{{ (isset($idFalla) && $falla->id == $idFalla) ? 'selected' : '' }}>
								{{ $falla->name }} | {{ $falla->address }}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="alert alert-warning" style="text-align: center;">
						¿No encuentras la falla que te saca de quicio?
						<a href="/fallas" class="btn btn-success">Creala tú</a>
					</div>
				</div>
				<div class="col-lg-12">
					<hr>
				</div>
				<div class="col-lg-6">
					<div class="input-group">
						<textarea name="text" placeholder="Comentario" class="form-control" required
						cols="70" rows="7" maxlength="500"></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="alert alert-info">
						<p><b>Nota:</b></p>
						Escribe un comentario de entre 20 y 500 carácteres. Sé respetuoso con tu 
						crítica o serás penalizado.
					</div>
				</div>
				<div class="col-lg-12">
					<hr>
				</div>
				<div class="col-lg-12">
					<input type="submit" name="submit" value="Enviar Queja" class="btn btn-success center-block">
				</div>
			</div>
		</form>
	</div>	
</div>

@stop