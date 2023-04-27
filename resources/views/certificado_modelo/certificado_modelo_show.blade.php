@extends('layouts.app')

@section('content')


<div class="container">
    @if($errors->any())
        <div class="row">
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        </div>
    @endif

    <div class='row justify-content-center'>
        <div class='col-12' style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Modelo de Certificado</h2>
        </div>
    </div>

    <form action="{{Route('certificado_modelo.edit', ['id'=>$modelo->id])}}" method="GET" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="unidade_administrativa_id" value="1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row">

                    <div class="form-group">
                        <label for="nome">Descrição:</label>
                        <input name="descricao" type="text" class="form-control" id="descricao" value="{{$modelo->descricao}}" disabled>
                    </div>

                    <div class="form-group">
                            <label for="imagem">Imagem de fundo:</label>
                            <div class="col-8">
                                <img src="{{$imagem}}" alt="" width="500" height="250">
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Imagem do verso</label>
                        <div class="col-8">
                            <img src="{{$verso}}" alt="" width="500" height="250">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="texto">Texto padrão:</label>
                        <textarea  name="texto" type="text" class="form-control" id="texto" rows='5' disabled>{{$modelo->texto}}</textarea>
                    </div>


                    <div class="row justify-content-end" style='margin-top: 15px;'>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                        <div class="col-2">
                            <a href="{{route('certificado_modelo.index')}}" class='btn btn-primary' style='margin-bottom: 10px'>Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection
