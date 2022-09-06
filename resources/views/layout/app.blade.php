<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased container">
        <div class="position-relative">
        @if (session('successo'))
        <div class="alert alert-success alert-dismissible fade show position-absolute w-100" role="alert">
            {{ session('successo') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('errore'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errore') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        </div>
        @yield('content')

        <script src="{{ URL::asset('js/jquery-3.6.1.min.js') }}"></script>
        <script src="{{ URL::asset('js/pusher.min.js') }}"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
        @yield('script')
        <script>
            window.setTimeout(function() {
                $(".alert-dismissible").removeClass('fade').removeClass('show').addClass('visually-hidden');
            }, 4000);
        </script>
    </body>
</html>
