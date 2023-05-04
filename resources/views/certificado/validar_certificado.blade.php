@extends('layouts.app')

@section('content')
    <div class='container'>
        <div class="row" >
            @if($errors->any())
                <div class="col-md-12" style="margin-top: 30px;">
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $erro)
                            <li>{{$erro}}</li>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Validar Certificado</h2>
        </div>

        <div>
            <form action="{{Route('validar_certificado.checar')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-3"></div>

                    <div class="col-6">
                        <div class="form-row">
                            <div class="form-gorup">
                                <label class='form-label' for="validacao">Validação</label>
                                <div class='col-10'>
                                    <input name="codigo_validacao" type="text" class="form-control col-4" id="codigo_validacao" placeholder="Código de Validação...">
                                </div>
                                <button type="submit" class="btn btn-success">Validar</button>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
