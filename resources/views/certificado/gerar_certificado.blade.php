<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Certificado </title>
        <style>
            body {
                background-image: url( {{ public_path($imagem) }});
                background-size: cover;
                font-family: Arial, sans-serif;
                text-align: center;
                padding-top: 100px;
            }
            p {
                font-size: 1.3em;
                color: #000000;
                text-shadow: 2px 2px #000;
                margin-top: 200px;
                margin-left: 300px;
                margin-right: 125px;
            }
        </style>
    </head>

    <body>
        <p> {{ $modelo->texto }}
            <br> <br> <br>
            Garanhuns, {{ date('d') }} de {{ $mes }} de {{ date('Y') }}

        </p>
    </body>
</html>
