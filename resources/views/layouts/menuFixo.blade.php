<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>menu comp</title>
    <link rel="stylesheet" href="/css/layouts/menu.css">
</head>
<body>
    <header class="Menu-layout-geral">
        <div class="tittle-box">

            <div class="logo-box">
                 <img class="icon" src="/images/layouts/menu/clipe.svg" alt="">
            </div>
            <div class="tittle-content">
                <h1 class="tittle">Certifica</h1>
            </div>
        </div>

        <div class="user-box">
            <div class="profile-box">
                <img class="profile-icon" src="/images/layouts/menu/profile.svg" alt="">
                <p class="profile-name">Olá, Nome</p>
            </div>

            <div class="button-exit-box">
                <img src="/images/layouts/menu/exit.svg" alt="">
            </div>
        </div>
    </header>
    <div>
        @yield('conteudo-menu')
    </div>
</body>
</html>
