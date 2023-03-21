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
