<html>
	<head>
		<meta charset="utf-8">
		<title>Las Fallas más Molestas</title>

		<!-- Bootstrap 3 -->
		<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap-theme.min.css') }}">
	</head>
	<body>
		@include('layouts.nav')
		
		<div class="container-fluid">
			@if ( isset($successMessage) )
				<div class="alert alert-success">{{ $successMessage }}</div>
			@elseif ( isset($errorMessage) )
				<div class="alert alert-danger">{{ $errorMessage }}</div>
			@endif

			@yield('content')
		</div>

		<!-- JQuery -->
		<script src="{{ URL::asset('jquery-2.1.3.min.js') }}"></script>
		<!-- Bootstrap JavaScript -->
		<script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>

		@yield('additionalJavaScript')		
	</body>
</html>