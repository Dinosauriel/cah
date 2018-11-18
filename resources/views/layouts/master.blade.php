<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset("favicon/apple-touch-icon.png") }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset("favicon/favicon-32x32.png") }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset("favicon/favicon-16x16.png") }}">
		<link rel="manifest" href="{{ asset("favicon/site.webmanifest") }}">
		<link rel="mask-icon" href="{{ asset("favicon/safari-pinned-tab.svg") }}" color="#000000">
		<link rel="shortcut icon" href="{{ asset("favicon/favicon.ico") }}">
		<meta name="msapplication-TileColor" content="#5a5a5a">
		<meta name="msapplication-config" content="{{ asset("favicon/browserconfig.xml") }}">
		<meta name="theme-color" content="#ffffff">


		<title>Cards Against Humanity</title>

		<link rel="stylesheet" href="/css/app.css">
	</head>
	<body>
		<div id="vue-app">			
			@include('layouts.header')
			<div class="container mb-5">
				@yield('content')
			</div>
			@include('layouts.footer')
		</div>
		<script src="/js/app.js"></script>
		@yield('scripts')
	</body>
</html>