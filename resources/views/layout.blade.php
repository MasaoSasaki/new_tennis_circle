<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>テニスサークル</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
	<header><h1>Tennis Circle</h1></header>
	<main>
		@yield('content')
	</main>
	<footer><small><a href="home">©︎ 2020 MasaoSasaki</a></small></footer>
</body>
</html>
