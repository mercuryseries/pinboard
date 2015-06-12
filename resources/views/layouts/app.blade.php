<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $title or 'pinboard' }}</title>
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>

	<div class="container">
		@include('flash::message')

		@yield('content')
	</div>

	<script src="/js/all.js"></script>
</body>
</html>