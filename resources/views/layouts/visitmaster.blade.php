<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css" >
		<title>Hospital Management System</title>
	</head>
	<body onload='getVisits()'>
		@include('layouts.nav')
        <div class="container">
            @yield("content")
        </div>
	</body>
</html>

