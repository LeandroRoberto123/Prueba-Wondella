<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba Wondella | LEANDRO</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="font-sans">

    <div id="app">
          <v-app id="inspire">  @yield('includes')</v-app>
    </div>
    <script src="{{ asset('js/app.js') }}" async defer></script>
</body>

</html>