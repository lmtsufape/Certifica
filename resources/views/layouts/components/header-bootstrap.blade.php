<header>
    @include('layouts.components.barra-brasil')

        <div class="row p-3" height="65">

            <div class="col p-l-30">
                <a class="navbar-brand" href="#">
                    <img
                    src="https://cdn-icons-png.flaticon.com/512/229/229930.png"
                    style="background-color: #FEDA1E; border-radius: 10px;"
                    class="p-1"
                    width="30"
                    height="100%">
                    <span class="fs-25 text-black">Certifica</span>
                </a>

            </div>
            @if (isset(Auth::user()->name ))
            <div class="col p-l-30">

                    <strong>{{ Auth::user()->name }}</strong>

            </div>
            @endif
        </div>
    <!-- END nav -->
</header>
