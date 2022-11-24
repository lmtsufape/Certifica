@extends('layouts.app')

@section('content')
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