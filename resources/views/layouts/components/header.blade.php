<header>
    @include('layouts.components.barra-brasil')
    <div class="d-flex p-3 flex-row justify-content-between">
            <div class="d-flex flex-column">
                <a href="/">
                    <div class="tittle-box">
                        <div class="logo-box">
                            <img class="icon" src="/images/layouts/menu/clipe.svg" alt="">
                        </div>
                        <div class="tittle-content tdl-nl">
                            <h1 class="tittle text-black tdl-nl">Certifica</h1>
                        </div>
                    </div>
                </a>
            </div>

            <div class="d-flex flex-row justify-content-around">
            @if (isset(Auth::user()->name ))
                    <div class="align-self-center">
                        <img class="profile-icon" src="/images/layouts/menu/profile.svg" alt="">
                    </div>

                        <p class="profile-name align-self-center">Olá, {{ Auth::user()->name }}</p>



                    <div class="button-exit-box align-self-center">
                        <img src="/images/layouts/menu/exit.svg" alt="">
                    </div>
            @endif
            </div>
        </div>
    </header>
    @yield('menu-content')
</html>


