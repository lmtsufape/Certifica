@extends('layouts.app')

@section('content')
<form action="{{Route('assinatura.update', ['id' => $assinatura->id])}}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('put') 
    <input type="hidden" name="usuario_id" value="1">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    
                    <div class="form-group">
                        <label for="img_assinatura">Imagem da assinatura</label>
                        <input name="img_assinatura" type="text" class="form-control" id="img_assinatura" placeholder="Link...">
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
@endsection