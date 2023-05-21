@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row justify-content-center'>
        <div class='col-12' style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>ATUALIZAR MODELO DE CERTIFICADO</h2>
        </div>
    </div>

    <form action="{{Route('certificado_modelo.update', ['id'=>$modelo->id])}}" method="POST" enctype="multipart/form-data" >
        @method('PUT')
        @csrf
        <input type="hidden" name="unidade_administrativa_id" value="1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row">

                    <div class="form-group">
                        <label for="nome">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao" value="{{$modelo->descricao}}">
                    </div>

                    <div class="form-group">
                        <label for="frente_certificado">Frente do Certificado</label>
                        <input name="fundo" type="file" class="form-control" id="fundo" accept="image/*" value='<?=$modelo->fundo;?>'>
                    </div>
                    <div class="col-3" style='margin-top: 5px;'>
                        <a href="{{route('certificado_modelo.show_img', ['id' => $modelo->id, 'imagem' => 'fundo'])}}"  class='btn btn-sm btn-outline-secondary' target="_blank">Ver imagem</a>
                    </div>

                    <div class="form-group">
                        <label for="verso_certificado">Verso do Certificado</label>
                        <input name="verso" type="file" class="form-control" id="verso" accept="image/*" value='<?=$modelo->verso;?>'>
                    </div>
                    <div class="col-3" style='margin-top: 5px;'>
                        <a href="{{route('certificado_modelo.show_img', ['id' => $modelo->id, 'imagem' => 'verso'])}}"  class='btn btn-sm btn-outline-secondary' target="_blank">Ver imagem</a>
                    </div>

                    <div class="form-group">
                        <label for="texto">Texto padrão:</label>
                        <textarea  name="texto" type="text" class="form-control" id="texto" rows='5'>{{$modelo->texto}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="unidade_adm">Unidade Administrativa</label>
                        <select name="unidade_adm" id="unidade_adm" class="form-select">
                            <option value='' selected></option>
                            @foreach($unidades as $unidade)
                                @if($unidade->id === $modelo->unidade_administrativa_id)
                                    <option value='{{$unidade->id}}' selected>{{$unidade->descricao}}</option>
                                @else
                                    <option value='{{$unidade->id}}'>{{$unidade->descricao}}</option>
                                @endif
                            @endforeach
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
