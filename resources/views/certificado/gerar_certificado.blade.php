<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Certificado </title>
        <style>
            .fundo_certificado {
                background-image: url( {{ public_path($imagem) }});
                background-size: cover;
                font-family: Arial, sans-serif;
                text-align: center;
                padding-top: 100px;
            }

            .fundo_verso {
                background-image: url( {{ public_path($verso) }});
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

            .codigo_validacao {
                font-size: 1.3em;
                color: #000000;
                text-shadow: 2px 2px #000;
                margin-top: 520px;
                margin-left: 1px;
                margin-right: 600px;
            }

            .qrcode {
                margin-top: -80px;
                margin-left: 900px;
                margin-right: 1px;
            }

        </style>
    </head>

    <body class="fundo_certificado">
        <p> {{ $modelo->texto }}
            <br> <br> <br>
            Garanhuns, {{ date('d') }} de {{ $mes }} de {{ date('Y') }}

        </p>
    </body>

    <body class="fundo_verso">
        <img class="qrcode" src="data:image/png;base64, {{ $qrcode }}">

        <p class="codigo_validacao"> Código de validação: {{ $certificado->codigo_validacao }} </p>
    </body>
</html>
