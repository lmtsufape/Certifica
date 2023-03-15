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

    <div class='row justify-content-center'>
        <h2 class='col-5'>CADASTRAR TIPO DE NATUREZA</h2>
    </div>
    <div>
        <form action="{{Route('tipo_natureza.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf 
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="row form-group">
                        <label class='form-label' for="descricao">Descrição</label>
                        <div class='col-10'>
                            <input name="descricao" type="text" class="form-control col-4" id="descricao" placeholder="Descricao...">
                        </div>
                        <div class='col-2'>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </div>
                      
                </div>
                
            </div>
        </form>
    </div>
</div>
@endsection