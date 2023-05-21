@extends('layouts.app')

@section('content')
    <div class="container">
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

                        <input name="descricao" type="hidden" id="descricao" value="{{$modelo->descricao}}">
                        <input name="fundo" type="hidden" id="imagem" value="{{ $modelo->fundo }}">
                        <input name="verso" type="hidden" id="verso" value="{{ $modelo->verso }}">
                        <input name="unidade_administrativa_id" type="hidden" id="unidade_administrativa_id" value=" {{ $modelo->unidade_administrativa_id }} ">Unidade Administrativa</input>

                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" value="{{$modelo->descricao}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="fundo_certificado">Imagem de fundo:</label>
                            <div class="col-8">
                                <img src="{{$img_fundo}}" alt="" width="500" height="250">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="verso_certificado">Verso:</label>
                            <div class="col-8">
                                <img src="{{$img_verso}}" alt="" width="500" height="250">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipo_certificado">Tipo Certificado</label>
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
                            <label>Unidade Administrativa</label>
                            <input type="text" class="form-control" value="{{ $unidade_adm->descricao }}" disabled>
                        </div>

                        <div class="row justify-content-end" style='margin-top: 5px;'>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                            <div class="col-2">
                                <a href="{{route('certificado_modelo.index', ['id'=>$modelo->id])}}" class='btn btn-primary' style='margin-left: 10px'>Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
