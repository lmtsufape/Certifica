<header class="navbar col-12 navbar-expand-md navbar-dark bg-white pt-4 pb-4">

    <div class="container w-100 d-flex align-items-center justify-content-around">

        <div class="col-sm-5 d-flex align-items-center justify-content-start">
            <a href="{{ Route('home') }}">
                <img class="logo-certifica" src="/images/layouts/header/logo-certifica.svg" alt="logo">
            </a>
        </div>

        <div class="col-sm-5 d-flex align-items-center justify-content-end">
            @if (Auth::check())
                <img id="hamburguer_button" class="hamburguer-button " src="/images/layouts/header/iconHamburguer.svg"
                     alt="">

                <ul id="menu-normal-logado" class="navbar-nav h-100 menu-normal-logado">

                    <li><a class="dropdown-item" href="{{ Route('home.sistema') }}">O Sistema</a></li>
                    <li><a class="dropdown-item" href="{{ Route('home.tutorial') }}">Tutorial de uso</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">
                            Verificação de Autenticidade
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ Route('home.contato') }}">Contato</a></li>
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-
                           style="color: white">
                            <span class="font-weight-bolder">Olá, </span>{{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('perfil.edit') }}">
                                {{ __('Editar Perfil') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}">
                                {{ __('Sair') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            @else
                <img id="hamburguer_button" class="hamburguer-button " src="/images/layouts/header/iconHamburguer.svg"
                     alt="">
                <ul id="menu_normal" class="navbar-nav h-100">
                    <li><a class="dropdown-item" href="/">Início</a></li>
                    <li><a class="dropdown-item" href="{{ Route('home.sistema') }}">O Sistema</a></li>
                    <li><a class="dropdown-item" href="{{ Route('home.tutorial') }}">Tutorial de uso</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">
                            Verificação de Autenticidade
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{ Route('home.contato') }}">Contato</a></li>

                </ul>
            @endif

        </div>
    </div>


    <!--Menu oculto responsivo -->
    @if (Auth::check())
        <div id="menu_responsivo_div" class="menu_responsivo_div ">

            <ul id="menu_responsivo" class="box-menu-responsivo some">

                <li><a class="dropdown-item" href="{{ Route('home.sistema') }}">O Sistema</a></li>
                <li><a class="dropdown-item" href="{{ Route('home.tutorial') }}">Tutorial de uso</a></li>
                <li>
                    <a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">
                        Verificação de Autenticidade
                    </a>
                </li>
                <li><a class="dropdown-item" href="{{ Route('home.contato') }}">Contato</a></li>
                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-
                       style="color: white">
                        <span class="font-weight-bolder">Olá, </span>{{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('perfil.edit') }}">
                            {{ __('Editar Perfil') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}">
                            {{ __('Sair') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    @else
        <div id="menu_responsivo_div" class="menu_responsivo_div ">

            <ul id="menu_responsivo" class="box-menu-responsivo some">
                <li><a class="dropdown-item" href="/">Inicio</a></li>
                <li><a class="dropdown-item" href="{{ Route('home.sistema') }}">O Sistema</a></li>
                <li>
                    <a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">
                        Verificação de Autenticidade
                    </a>
                </li>
                <li><a class="dropdown-item" href="{{ Route('home.contato') }}">Contato</a></li>
                <li><a class="dropdown-item" href="{{ Route('home.tutorial') }}">Tutorial de uso</a></li>
            </ul>
        </div>
    @endif




    <script>
        //DOM
        var hamburguer = document.getElementById("hamburguer_button");
        var click = 0;
        var menu_responsivo = document.getElementById("menu_responsivo");



        //logica do menu responsivo sumindo e voltando ao clicar
        hamburguer.addEventListener("click", (e) => {
            if (click % 2 == 0) {
                menu_responsivo.classList.remove("some")
                menu_responsivo.classList.add("aparece")
            } else {

                menu_responsivo.classList.remove("aparece")
                menu_responsivo.classList.add("some")
            };
            click++;
        });
    </script>
</header>
