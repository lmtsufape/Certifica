<header class="navbar col-12 navbar-expand-md navbar-dark bg-white pt-4 pb-4">

    <div class="container w-100 d-flex align-items-center justify-content-around">

        <div class="col-sm-5 d-flex align-items-center justify-content-start">
            <a href="{{ route('home') }}">
                <img class="logo-certifica" src="/images/layouts/header/logo-certifica.svg" alt="logo">
            </a>
        </div>

        <div class="col-sm-5 d-flex align-items-center justify-content-end">
            @if (Auth::check())
                <img id="hamburguer_button" class="hamburguer-button" src="/images/layouts/header/iconHamburguer.svg" alt="">

                <ul id="menu-normal-logado" class="navbar-nav h-100 menu-normal-logado">
                    <li><a class="dropdown-item" href="{{ route('home.sistema') }}">O Sistema</a></li>
                    <li><a class="dropdown-item" href="{{ route('home.tutorial') }}">Tutorial de uso</a></li>
                    <li><a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">Verificação de Autenticidade</a></li>
                    <li><a class="dropdown-item" href="{{ route('home.contato') }}">Contato</a></li>
                    <li class="dropdown">
                        <button onclick="toggleDropdown()" class="dropbtn">
                            <span class="font-weight-bolder">Olá,&nbsp;<span> </span> </span>{{ explode(' ', Auth::user()->name)[0]}}
                        </button>
                        <div id="myDropdown" class="dropdown-content">
                            <a class="dropdown-item" href="{{ route('perfil.edit') }}">{{ __('Editar Perfil') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Sair') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            @else
                <img id="hamburguer_button" class="hamburguer-button" src="/images/layouts/header/iconHamburguer.svg" alt="">
                <ul id="menu_normal" class="navbar-nav h-100">
                    <li><a class="dropdown-item" href="/">Início</a></li>
                    <li><a class="dropdown-item" href="{{ route('home.sistema') }}">O Sistema</a></li>
                    <li><a class="dropdown-item" href="{{ route('home.tutorial') }}">Tutorial de uso</a></li>
                    <li><a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">Verificação de Autenticidade</a></li>
                    <li><a class="dropdown-item" href="{{ route('home.contato') }}">Contato</a></li>
                </ul>
            @endif
        </div>
    </div>

    <!-- Menu oculto responsivo -->
    @if (Auth::check())
        <div id="menu_responsivo_div" class="menu_responsivo_div">
            <ul id="menu_responsivo" class="box-menu-responsivo some">
                <li><a class="dropdown-item" href="{{ route('home.sistema') }}">O Sistema</a></li>
                <li><a class="dropdown-item" href="{{ route('home.tutorial') }}">Tutorial de uso</a></li>
                <li><a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">Verificação de Autenticidade</a></li>
                <li><a class="dropdown-item" href="{{ route('home.contato') }}">Contato</a></li>
                <li class="dropdown">
                    <button onclick="toggleDropdownResponsive()" class="dropbtn">
                        <span class="font-weight-bolder">Olá, </span>{{ explode(' ', Auth::user()->name)[0] }}
                    </button>
                    <div id="myDropdownResponsive" class="dropdown-content">
                        <a class="dropdown-item" href="{{ route('perfil.edit') }}">{{ __('Editar Perfil') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">{{ __('Sair') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    @else
        <div id="menu_responsivo_div" class="menu_responsivo_div">
            <ul id="menu_responsivo" class="box-menu-responsivo some">
                <li><a class="dropdown-item" href="/">Início</a></li>
                <li><a class="dropdown-item" href="{{ route('home.sistema') }}">O Sistema</a></li>
                <li><a class="dropdown-item" href="{{ route('home.tutorial') }}">Tutorial de uso</a></li>
                <li><a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">Verificação de Autenticidade</a></li>
                <li><a class="dropdown-item" href="{{ route('home.contato') }}">Contato</a></li>
            </ul>
        </div>
    @endif

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: transparent;
            border: none;
            color: black; /* Ajustar a cor conforme necessário */
            padding: 14px 20px; /* Aumenta o padding para dar mais espaço */
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px; /* Aumenta a largura mínima */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1000; /* Aumentado z-index para garantir que fique na frente */
            right: 0;
            top: 100%;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .show {
            display: block;
        }
    </style>

    <script>
        // Função para o dropdown principal
        function toggleDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Função separada para o dropdown responsivo para evitar conflitos
        function toggleDropdownResponsive() {
            document.getElementById("myDropdownResponsive").classList.toggle("show");
        }

        // Fecha os dropdowns se o usuário clicar fora deles
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

</header>
