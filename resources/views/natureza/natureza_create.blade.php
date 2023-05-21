@extends('layouts.app')

@section('title')
    Cadastrar Naturezas
@endsection

@section('content')
    <div class="container">
        <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
            <h2>Cadastrar Unidade Administrativa</h2>
        </div>

        <form action="{{Route('natureza.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="descricao_natureza">Descrição</label>
                            <input name="descricao" type="text" class="form-control" id="descricao_natureza" placeholder="Descrição">
                        </div>

                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>

@endsection
