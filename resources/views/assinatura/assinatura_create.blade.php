@extends('layouts.app')

@section('content')

<div class="container">
    @if($errors->any())
    <div class="row">
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
    </div>
    @endif
<form action="{{Route('assinatura.store')}}" method="POST" enctype="multipart/form-data" >
    @csrf 
    
    <div class='row justify-content-center'>
        <div class='col-4'>
            <h1>Cadastrar Assinatura</h1>
        </div>
        <div class='row justify-content-center'>
            <div class='col-4'>
                <label for="user_id">Usuário</label>
                <select class="form-select" name="user_id" id="user_id">
                    <option selected></option>
                    @foreach ($users as $user)
                        <option value={{$user->id}}>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class='row justify-content-center'>
            <div class="col-4" style='margin-top: 5px'>
                <label for="img_assinatura">Imagem da assinatura</label>
                <input name="img_assinatura" type="file" class="form-control" accept="image/*" id="img_assinatura">
            </div>
        </div>
        <div class='row justify-content-end'>
            <div class='col-5' style='margin-top: 15px; margin-right:10px'>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
                
    </div>
</form>
</div>
@endsection