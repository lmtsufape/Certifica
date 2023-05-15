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

    <div class="text-center" style="border-bottom: #949494 2px solid; padding-bottom: 5px; margin-bottom: 10px">
        <h2>Cadastrar Tipo de Natureza</h2>
    </div>

    <div>
        <form action="{{Route('tipo_natureza.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-6">
                    <div class="form-row">
                        <div class="form-gorup">
                            <label class='form-label' for="descricao">Descrição</label>
                            <div class='col-10'>
                                <input name="descricao" type="text" class="form-control col-4" id="descricao" placeholder="Descricao...">
                            </div>

                            <div class="form-group">
                                <label for="tipo_natureza">Natureza</label>

                                <select name="tipo_natureza_id" id="tipo_natureza" class="form-control">
                                    <option value="" selected hidden>-- Natureza --</option>
                                    @foreach($naturezas as $natureza)
                                        <option value="{{ $natureza->id }}">{{ $natureza->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                    </div>

                </div>

                <div class="col-md-3"></div>
            </div>
        </form>
    </div>
</div>
@endsection
