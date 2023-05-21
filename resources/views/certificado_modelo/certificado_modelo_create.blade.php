@extends('layouts.app')

@section('content')


<div class="container">
    <div class='row justify-content-center'>
        <div class='col-12' style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>CADASTRAR MODELO DE CERTIFICADOS</h2>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-1">
            <a href="{{route('certificado_modelo.index')}}" class='btn btn-primary' style='margin-bottom: 10px'>Voltar</a>
        </div>
    </div>

    <form action="{{Route('certificado_modelo.store')}}" method="POST" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="unidade_administrativa_id" value="1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row">

                    <div class="form-group">
                        <label for="nome">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao" placeholder="Nome do modelo">
                    </div>

                    <div class="form-group">
                        <label for="fundo_certificado">Imagem de fundo</label>
                        <input name="fundo" type="file" class="form-control" id="fundo" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="verso_certificado">Verso</label>
                        <input name="verso" type="file" class="form-control" id="verso" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="texto">Texto padrão:</label>
                        <textarea  name="texto" type="text" class="form-control" id="texto" placeholder="Texto padrão do certificado ..." rows='5'></textarea>
                    </div>

                    <div class="form-group">
                        <label for="unidade_adm">Unidade Administrativa</label>
                        <select name="unidade_adm" id="unidade_adm" class="form-select">
                            <option value="" selected></option>
                            @foreach($unidades as $unidade)
                                <option value={{$unidade->id}}>{{$unidade->descricao}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary" style='margin-top: 5px;'>Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
