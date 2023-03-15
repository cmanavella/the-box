<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-grid.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-reboot.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-utilities.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/estilos.css') }}" />

        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="https://kit.fontawesome.com/d2bde4eca0.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery-3.6.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/functions.js') }}"></script>

        <title>The Box</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
