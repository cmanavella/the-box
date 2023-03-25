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

        <script type="text/javascript" src="{{ URL::asset('js/jquery-3.6.4.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <script src="https://kit.fontawesome.com/d2bde4eca0.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ URL::asset('js/functions.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/modals.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/validations.js') }}"></script>

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
