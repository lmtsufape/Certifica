@extends('layouts.app')

@section('content')
<form action="{{Route('certificado_modelo.store')}}" method="POST" enctype="multipart/form-data" >
    @csrf 
        <input type="hidden" name="unidade_administrativa_id" value="1">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    
                    <div class="form-group">
                        <label for="assinatura_esquerda">assinatura_esquerda</label>
                        <input name="assinatura_esquerda" type="text" class="form-control" id="assinatura_esquerda" placeholder="Link...">
                    </div>

                    <div class="form-group">
                        <label for="assinatura_direita">assinatura_direita</label>
                        <input name="assinatura_direita" type="text" class="form-control" id="assinatura_direita" placeholder="Link...">
                    </div>

                    <div class="form-group">
                        <label for="data_posicao">data_posicao</label>
                        <input name="data_posicao" type="text" class="form-control" id="data_posicao" placeholder="Link...">
                    </div>

                    <div class="form-group">
                        <label for="texto_posicao">texto_posicao</label>
                        <input name="texto_posicao" type="text" class="form-control" id="texto_posicao" placeholder="Link...">
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
@endsection