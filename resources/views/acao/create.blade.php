@extends('layouts.app')

@section('content')
<form action="{{Route('acao.store')}}" method="POST" enctype="multipart/form-data" >
    @csrf 
    <input type="hidden" name="natureza_id" value="1">
    <input type="hidden" name="usuario_id" value="1">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-row">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input name="titulo" type="text" class="form-control" id="titulo" placeholder="Título">
                    </div>

                    <div class="form-group">
                        <label for="data_inicio">Data início</label>
                        <input name="data_inicio" type="date" class="form-control" id="data_inicio" placeholder="dd/mm/aa">
                    </div>

                    <div class="form-group">
                        <label for="data_fim">Data fim</label>
                        <input name="data_fim" type="date" class="form-control" id="data_fim" placeholder="dd/mm/aa">
                    </div>

                    <div class="form-group">
                        <label for="ativo">Ativo</label>
                        <select name="status" class="form-control" id="exampleFormControlSelect1">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
@endsection