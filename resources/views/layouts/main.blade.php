<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script defer="defer" src="//barra.brasil.gov.br/barra_2.0.js" type="text/javascript"></script>



    <link rel="stylesheet" href="{{asset ('css/main/style.css') }}">
    <link rel="stylesheet" href="{{asset ('css/main/util.css') }}">
    <link rel="stylesheet" href="{{asset ('css/layouts/menu.css') }}">
</head>
<body>
    <section>
        @include('layouts.components.header')
    </section>

    <main class="py-4">
        @yield('content')
    </main>

    @include('layouts.components.footer')

</body>
</html>
