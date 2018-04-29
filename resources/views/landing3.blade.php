<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vue-Laravel</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="content" id="app">

    <example-component></example-component>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script type="text/javascript" src="/js/app.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBayLe_XQAbUS883JqwQEhLRNwDM7XCFyU&callback=initMap"></script>

</body>
</html>
