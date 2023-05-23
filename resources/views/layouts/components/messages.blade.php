<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        @if(session('mensagem'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="width:50%">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <span>{{session('mensagem')}}</span>
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        @if(session('error_mensage'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <span>{{session('error_mensage')}}</span>
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:50%">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
