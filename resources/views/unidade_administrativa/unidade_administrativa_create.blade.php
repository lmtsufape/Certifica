@extends('layouts.app')

@section('content')
    <form action="{{Route('unidade_administrativa.store')}}" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="titulo">Descrição</label>
                        <input name="descricao" type="text" class="form-control" id="descricao" placeholder="Descrição">
                    </div>

                    <input type="hidden" name="setor_id" value="1">

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
@endsection
