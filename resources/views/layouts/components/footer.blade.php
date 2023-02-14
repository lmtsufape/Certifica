<footer class="container-fluid pt-1 mt-5" style="background-color: #303030;">
    <div class="container-fluid px-lg-5">
        <div class="row justify-content-between  my-2">

            <div class="col-md-4 text-center py-1 border-right">
                <a class="navbar-brand mx-3" href="{{ url('/') }}">
                    Certifica
                </a>
            </div>

            <div class="col-md-4 text-center py-1 border-right">
                <div class="form-row">
                    <div class="col-md-12">
                        <h6 class="textoRodape text-white">Desenvolvido por:</h6>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12" style="margin-bottom: 1rem;">
                        <div class="row justify-content-center">
                            <div class="col-1"></div>
                            <div class="col-5">
                                <a href="http://ufape.edu.br/" target="_blank"><img
                                        src="{{ asset('images/logo_ufape.png') }}" alt="Logo" width="90px;" height="138px;" style="float: right"></a>
                            </div>
                            <div class="col-5">
                                <a href="http://lmts.uag.ufrpe.br/" target="_blank"><img
                                        src="{{ asset('images/logo_lmts_color.png') }}" alt="Logo" width="180px"></a>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 text-center mt-1">
                <span class="textoRodape text-white">Contato:</span>
                <div class="row justify-content-center text-center mt-4">
                    <a href="https://www.facebook.com/LMTSUFAPE/" target="_blank" class="col-md-1 p-0"> <img height="40"
                                                                                                             src="{{asset('images/facebook_logo.png')}}"></a>
                    <a href="https://www.instagram.com/lmts_ufape/" target="_blank" class="col-md-1 p-0 mx-2"> <img
                            height="40" src="{{asset('images/instagram_logo.png')}}"></a>
                    <a href="mailto:lmts@ufrpe.br" class="col-md-1 p-0"> <img height="40"
                                                                              src="{{asset('images/google_logo.png')}}"></a>
                </div>
            </div>
        </div>
    </div>
</footer>


