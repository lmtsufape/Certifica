<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/components/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="header-container d-flex flex-row-reverse align-items-end">
        <div>
            <img class="seta-icon" src="/images/acoes/create/seta.svg" alt="">
        </div>
        <div class="nome-user">
            Olá, nome
        </div>
        <div>
            <img class="profile-icon" src="/images/acoes/create/profile.svg" alt="">
        </div>
        <div>
            <img class="sino-icon" src="/images/acoes/create/sino.svg" alt="">
        </div>
    </div>


    <div>
        @yield('content-header')
    </div>
</body>
</html>


