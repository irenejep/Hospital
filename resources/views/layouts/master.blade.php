<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css" >
		<title>Hospital Management System</title>
	</head>
	<body>
		@include('layouts.nav')
        <div class="container">
            @yield("content")
        </div>
	</body>
</html>

