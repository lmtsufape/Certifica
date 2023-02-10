<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset ('css/main/style.css') }}">
    <link rel="stylesheet" href="{{asset ('css/main/util.css') }}">
    <link rel="stylesheet" href="{{asset ('css/layouts/menu.css') }}">
</head>
<body>
    <section>
        @include('layouts.components.barra-brasil')
        @include('layouts.components.header')
        @yield('header')
    </section>

    <section>
        @yield('content')
    </section>

    <section>
        @include('layouts.components.footer')
    </section>

</body>
</html>
