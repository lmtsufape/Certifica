<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Style -->
    <link rel="stylesheet" href="/css/main/style.css">
    <link rel="stylesheet" href="/css/components/geral.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
          integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script defer="defer" src="//barra.brasil.gov.br/barra_2.0.js" type="text/javascript"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
</head>


<body>
    <div class="header-container d-flex flex-row-reverse align-items-end">
        @if(Auth::check())
            <div>
                <img class="seta-icon" src="/images/acoes/create/seta.svg" alt="">
            </div>
                <div class="nome-user">
                    Olá, {{Auth::user()->name}}
                </div>
            
            <div>
                <img class="profile-icon" src="/images/acoes/create/profile.svg" alt="">
            </div>
            <div>
                <img class="sino-icon" src="/images/acoes/create/sino.svg" alt="">
            </div>
        @endif
    </div>


    <div>
        @yield('content-geral')
    </div>

    <footer class="container-fluid pt-1 mt-5" >
        <div class="container-fluid px-lg-5">
            <div class="row justify-content-between  my-2">

                <div class="col-md-4 text-center py-1 border-right">
                    <a class="navbar-brand mx-3" href="{{ url('/') }}">
                        Certifica
                    </a>
                </div>

                <div class="col-md-4 text-center d-flex flex-column justify-content-center py-1 border-right">

                    <div class="form-row">
                        <div class="col-md-12">
                            <h6 class="textoRodape text-white">Desenvolvido por</h6>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex flex-row" style="margin-bottom: 1rem;">
                            <div class="col-5">
                                <a href="http://ufape.edu.br/" target="_blank"><img
                                        src="{{ asset('images/layouts/footer/ufape.svg') }}" alt="Logo" width="44px;" height="67px;" style="float: right"></a>
                            </div>
                            <div class="col-5">
                                <a href="http://lmts.uag.ufrpe.br/" target="_blank"><img
                                        src="{{ asset('images/layouts/footer/lmts.svg') }}" alt="Logo" width="54px"></a>
                            </div>
                    </div>

                </div>

                <div class="col-md-4 text-center d-flex justify-content-center  mt-1">
                    <div class="d-flex flex-column">
                        <span class="textoRodape text-white text-center">Contato</span>

                        <div class="text-icons d-flex aling-self-start">
                            <a href="mailto:lmts@ufape.br" class="text-icons">
                                <img idth="18px" height="15px" src="{{asset('images/layouts/footer/mail.svg')}}">
                                lmts@ufape.edu.br
                                </a>
                        </div>
                        <div class="text-icons d-flex aling-self-start">
                            <a href="https://www.instagram.com/lmts_ufape/" target="_blank" class="text-icons">
                                <img idth="18px" height="18px" src="{{asset('images/layouts/footer/instagram.svg')}}">
                                lmts_ufape
                            </a>
                        </div>

                        <div class=" d-flex aling-self-start">
                            <a href="https://www.facebook.com/LMTSUFAPE/" target="_blank" class="text-icons">
                                <img width="18px" height="18px" src="{{asset('images/layouts/footer/facebook.svg')}}">
                                /lmtsufape/
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </footer>


</body>
</html>


