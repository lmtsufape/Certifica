<header class="navbar col-12 navbar-expand-md navbar-dark bg-white pt-4 pb-4">

    <div class="container w-100 d-flex align-items-center justify-content-around">

        <div class="col-sm-5 d-flex align-items-center justify-content-start">
            <a href={{ Route('home') }}>
                <img class="logo-certifica" src="/images/layouts/header/logo-certifica.svg" alt="logo">
            </a>
        </div>

        <div class="col-sm-5 d-flex align-items-center justify-content-end">
            @if (Auth::check())
                <ul class="navbar-nav ms-auto mr-4">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-
                            style="color: white">
                            <span class="font-weight-bolder">Olá, </span>{{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                <ul class="navbar-nav h-100">
                    <li><a class="dropdown-item" href="/">Inicio</a></li>
                    <li><a class="dropdown-item" href="{{route('sistema') }}">O Sistema</a></li>
                    <li>
                        <a class="dropdown-item" href="{{route('validar_certificado.validar') }}">
                            Validar Certificado
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="">Contato</a></li>

                </ul>
            @endif

        </div>
    </div>
</header>
