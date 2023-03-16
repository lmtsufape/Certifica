@extends('layouts.app')

@section('title')
    Editar Participante
@endsection

@section('content')
<div class="container">
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error) 
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
    </div>
    <div class="row">
        @if(session('mensagem'))    
            <div class="alert alert-success">
                {{session('mensagem')}}
            </div>
        @endif
    </div>
            
            

            <form action="{{Route('participante.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="atividade_id" value="{{ $atividade->id }}">
                <input type="hidden" name="id" value="{{$participante->id}}">
                
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nome_participante">Nome</label>
                                <input name="nome" type="text" class="form-control" id="nome_participante" placeholder="Nome"
                                value="{{ $participante->nome }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="cpf_participante">CPF</label>
                                <input name="cpf" type="text" class="form-control" id="cpf_participante" placeholder="000.000.000-00"
                                value="{{ $participante->cpf }}">
                            </div>
                            
                    <div class="form-group">
                        <label for="email_participante">Email</label>
                        <input name="email" type="text" class="form-control" id="email_participante" placeholder="example@gmail.com"
                        value="{{ $participante->email }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="info_atividade">Título</label>
                        <input name="titulo" type="text" class="form-control" id="titulo_atividade" placeholder="ex: Palestra Redes Naurais"
                        value="{{ $participante->titulo }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="carga_horaria_atividade">Carga Horária</label>
                        <input name="carga_horaria" type="text" class="form-control" id="carga_horaria_atividade" placeholder="Cargas Horária"
                        value="{{ $participante->carga_horaria }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="participante_atividade">Atividade</label>
                        <input name="atividade" type="text" class="form-control" id="acao_titulo" value="{{ $atividade->descricao }}" disabled>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>

</div>
@endsection
