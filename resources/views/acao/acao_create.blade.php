@extends('layouts.components.geral')

@section('content-geral')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/css/acoes/create.css">
        <title>Criar Ação</title>
    </head>
    <body>
        <form class="view-create-acao" action="{{Route('acao.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf

            <input type="hidden" name="usuario_id" value="{}">
            <input type="hidden" name="unidade_administrativa_id" value="{}">


            [menu aqui]
        </form>
    </body>
    </html>
@endsection
