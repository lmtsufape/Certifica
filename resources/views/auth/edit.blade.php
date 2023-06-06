@extends('layouts.app')

@section('title')
    Editar Perfil
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <h3>Editar Perfil</h3>
                                </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                
                                <form action="{{route('perfil.update')}}" method='POST'>
                                    @csrf
                                    <div class="row">
                                        <div>
                                            <label for="nome">Nome Completo</label>
                                            <input name='nome' id='nome' class="form-control" value="{{$user->name}}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="cpf">CPF</label>
                                            <input name='cpf' id='cpf' class="form-control" value="{{$user->cpf}}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email">E-mail</label>
                                            <input name='email' id='email' class="form-control" value="{{$user->email}}">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="celular">Celular</label>
                                            <input name='celular' id='celular' class="form-control" value="{{$user->celular}}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="perfil">Perfil</label>
                                            <input name='perfil' id='perfil' class="form-control" value="{{$user->perfil->nome}}" disabled>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="instituição">Instituição de Vínculo</label>
                                            <input name='instituição' id='instituição' class="form-control" value="{{$instituicao}}" disabled>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="senha">Senha</label>
                                            <input name='senha' id='senha' class="form-control">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="confirmar_senha">Confirmar Senha</label>
                                            <input name='confirmar_senha' id='confirmar_senha' class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-center" style="padding-top:5%;">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-outline-dark btn-sm" style="margin-right:20%;">Editar</button>    
                                            <a href="" class="btn btn-outline-danger btn-sm">Voltar</a>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection