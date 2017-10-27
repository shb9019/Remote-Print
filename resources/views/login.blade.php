<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		<link href="{{ mix('css/login.css') }}" rel="stylesheet">
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		<div id="main">
			<div id="left"></div>
			<div id="right"></div>
		</div>
		<script src="{{ mix('js/login.js') }}"></script>
	</body>
</html>