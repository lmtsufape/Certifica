@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row" >
        @if($errors->any())
        <div class="col-md-12" style="margin-top: 30px;">
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        </div>
        @endif
    </div>

</div>
<form action="{{Route('tipo_natureza.update', ['id' => $tipo_natureza->id])}}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('put') 
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao" value={{$tipo_natureza->descricao}}>
                    </div>

                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
@endsection