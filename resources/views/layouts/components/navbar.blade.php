<nav class="navbar navbar-expand-md navbar-dark bg-white border-bottom pt-4 pb-4">

    <div class="col-3 d-flex align-items-center justify-content-center">
        <a href={{Route('home')}}>
            <img src="/images/layouts/header/logo-certifica.svg" alt="">
        </a>
    </div>


    @if (Auth::check())
        @if (Auth::user()->perfil_id == 1)
      
        @elseif(Auth::user()->perfil_id == 2)

        @elseif(Auth::user()->perfil_id == 3)
        
        @endif
    @else
        <ul class="navbar-nav ms-auto mr-4">
            <li><a class="dropdown-item" href="{{ route('validar_certificado.validar') }}">Validar Certificado</a></li>
        </ul>
    @endif



    <ul class="navbar-nav ms-auto mr-4">
        @if (Auth::check())
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-black" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v- style="color: white">
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
        @endif
    </ul>
</nav>
