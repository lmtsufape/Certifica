<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="/css/layouts/menu.css">
</head>
    <header>
        @include('layouts.components.barra-brasil')
        <div class="header-layout container d-flex align-items-center">
            <div class="col-1 d-flex justify-content-center">
                <div class="container-clipe d-flex align-items-center justify-content-center">
                    <img src="/images/layouts/menu/clipe.svg" alt="">
                </div>
            </div>
            <div class="tittle col-5 d-flex align-items-end"><h1>Certifica</h1></div>
            <div class="user-box col-5 d-flex align-items-end justify-content-end">
                <img class="icon-user" src="/images/layouts/menu/profile.svg" alt="" srcset="">
                <span class="name-user">Olá, Nome</span>
            </div>
            <div class="exit-box col-1 d-flex align-items-end justify-content-center"><img src="/images/layouts/menu/exit.svg" alt="" srcset=""></div>
        </div>
    </header>
    @yield('menu-content')
</html>


