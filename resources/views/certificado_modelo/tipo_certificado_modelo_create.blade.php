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
                <h2>CRIAR MODELO DE CERTIFICADO</h2>
            </div>
        </div>

        <form action="{{Route('tipo_certificado_modelo.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="row">

                        <div class="form-group">
                            <label for="nome">Descrição</label>
                            <input name="descricao" type="text" class="form-control" id="descricao" value="{{$modelo->descricao}}">
                        </div>

                        <div class="form-group">
                            <label for="imagem">Imagem de fundo</label>
                            <input name="imagem" type="text" class="form-control" id="imagem" value="{{ $modelo->imagem }}">
                        </div>

                        <div class="form-group">
                            <label for="tipo_certificado">Unidade Administrativa</label>
                            <select name="tipo_certificado" id="tipo_certificado" class="form-control">
                                @foreach($tipos_certificado as $tipo)
                                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="texto">Texto padrão:</label>
                            <textarea  name="texto" class="form-control" id="texto" rows='5'>{{$modelo->texto}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="unidade_adm">Unidade Administrativa</label>
                            <select name="unidade_administrativa_id" id="unidade_adminitsrativa" class="form-control">
                                <option value=" {{ $modelo->unidade_administrativa_id }}" selected hidden>{{ $unidade_adm->descricao }}</option>
                            </select>
                        </div>
                        <div class="row justify-content-end" style='margin-top: 5px;'>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                            <div class="col-2">
                                <a href="{{route('certificado_modelo.show', ['id'=>$modelo->id])}}" class='btn btn-primary' style='margin-left: 10px'>Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
