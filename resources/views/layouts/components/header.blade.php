<header>
    <!-- @include('layouts.components.barra-brasil') -->
    <div class="d-flex p-3 flex-row  justify-content-between align-content-center flex-wrap">

        <div class="d-flex flex-column m-l-30">
            <a href="/" >
                <div class="tittle-box">
                    <div class="logo-box">
                        <img class="icon" src="/images/layouts/menu/arquivo da logo" alt="">Logo</img>
                    </div>
                </div>
            </a>
        </div>

        <div class="d-flex flex-row align-items-center justify-content-between">
            @if (isset(Auth::user()->name ))
                <div class="align-self-center">
                    <img class="profile-icon" src="/images/layouts/menu/profile.svg" alt="">
                </div>

                <div class=" align-self-center mt-3">
                    <p class="profile-name">Olá, {{ Auth::user()->name }}</p>
                </div>

                <div class=" align-self-center">
                    <a method="POST" href="{{ route('login.logout') }}">
                        <img src="/images/layouts/menu/exit.svg">
                    </a>

                </div>
            @endif
        </div>
    </div>
</header>


