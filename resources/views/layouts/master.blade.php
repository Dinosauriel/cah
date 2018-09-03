<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Cards Against Humanity</title>

		<link rel="stylesheet" href="/css/app.css">
	</head>
	<body>
		<div id="vue-app">			
			@include('layouts.header')
			<div class="container">
				@yield('content')
			</div>
			@include('layouts.footer')
		</div>
		<script src="/js/app.js"></script>
		@yield('scripts')
	</body>
</html>