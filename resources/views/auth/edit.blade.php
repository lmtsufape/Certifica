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
                                            <label for="name">Nome Completo</label>
                                            <input name='name' id='name' class="form-control" value="{{$user->name}}">
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
                                            <input name='celular' id="telefone" class="form-control" value="{{$user->celular}}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="perfil">Perfil</label>
                                            <input name='perfil' id='perfil' class="form-control" value="{{$user->perfil->nome}}" disabled>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="instituicao">Instituição de Vínculo</label>
                                            <input name='instituicao' id='instituicao' class="form-control" value="{{$instituicao}}" disabled>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="password">Senha</label>
                                            <input name='password' id='password' class="form-control" type="password">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="password_confirmation">Confirmar Senha</label>
                                            <input name='password_confirmation' id='password_confirmation' class="form-control" type="password">
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