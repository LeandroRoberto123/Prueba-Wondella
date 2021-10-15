<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prueba Wondella | LEANDRO</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        a{
            text-decoration: none!important;
        }
        .content-btn-history{
            margin: auto;
    display: block;
    top: -18px;
    width: fit-content;
    position: relative;

    background: #f5f5f5;
    border: 2px solid #f5f5f5;
    border-radius: 50%;
}

       
        .content-menu{
    border-bottom-left-radius: 13px;
    border-bottom-right-radius: 13px;
        }
        .menu-principal .v-slide-group__content.v-tabs-bar__content{
            align-items: center;
        }
        .menu-custom-active .v-icon{
            color: #FFF !important;
        }
        .menu-custom-active{
            background-color: #022F95;
            border-radius: 8px;
            height: 39px;
    max-width: 39px!important;
    min-width: 39px!important;
        }
        .menu-custom{
            margin: 5px;
            border-radius: 8px;
            height: 39px;
    max-width: 39px!important;
    min-width: 39px!important;
        }
    </style>
</head>

<body class="font-sans">

    <div id="app">
          <v-app id="inspire">  @yield('includes')</v-app>
    </div>
    <script src="{{ asset('js/app.js') }}" async defer></script>
</body>

</html>