@extends('layouts.app')

@section('content')
<form action="{{Route('certificado.update', ['id' => $certificado->id])}}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('put') 
    <input type="hidden" name="atividade_id" value="1">
    <input type="hidden" name="certificado_modelo_id" value="1">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    
                    <div class="form-group">
                        <label for="assinatura_esquerda">assinatura_esquerda</label>
                        <input name="assinatura_esquerda" type="text" class="form-control" id="img_fundo" placeholder="Link...">
                    </div>

                    <div class="form-group">
                        <label for="img_fundo">img_fundo</label>
                        <input name="img_fundo" type="text" class="form-control" id="assinatura_direita" placeholder="Link...">
                    </div>

                    <div class="form-group">
                        <label for="texto">texto</label>
                        <input name="texto" type="text" class="form-control" id="texto" placeholder="Link...">
                    </div>

                    <div class="form-group">
                        <label for="logo">logo</label>
                        <input name="logo" type="text" class="form-control" id="logo" placeholder="Link...">
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
@endsection