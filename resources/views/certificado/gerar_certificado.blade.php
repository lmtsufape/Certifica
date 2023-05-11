<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title> Certificado </title>
        <style>
            @font-face {
                font-family: gyre;
                src: url('public/fonts/tex-gyre-termes/texgyretermes-regular.otf');
            }

            *{
                margin: 0px;
                padding: 0px;
                font-family: gyre;
            }

            .fundo_certificado {
                background-image: url( {{ public_path($imagem) }});
                background-size: cover;
                font-family: Arial, sans-serif;
                text-align: center;
                padding-top: 100px;
            }

            .verso_certificado {
                background-image: url( {{ public_path($verso) }});
                background-size: cover;
                font-family: Arial, sans-serif;
                text-align: center;
                padding-top: 100px;
            }

            .texto_certificado {
                font-size: 20px;
                color: #000000;
                text-shadow: 2px 2px #000;
                margin-top: 200px;
                margin-left: 300px;
                margin-right: 125px;
            }

            .codigo_validacao {
                font-size: 16px;
                color: #000000;
                text-shadow: 2px 2px #000;
                margin-top: 175px;
                margin-left: 35px;
                margin-right: 575px;
            }

            .qrcode {
                height: 35%;
                margin-top: 150px;
                margin-left: 670px;
                margin-right: 1px;
            }

        </style>
    </head>

    <body class="fundo_certificado">
        <p class="texto_certificado"> {{ $modelo->texto }}
            <br> <br> <br>
            Garanhuns, {{ date('d') }} de {{ $mes }} de {{ date('Y') }}

        </p>
    </body>

    <body class="verso_certificado">
        <img class="qrcode" src="data:image/png;base64, {{ $qrcode }}">

        <p class="codigo_validacao"> Código de validação: {{ $certificado->codigo_validacao }} </p>
    </body>
</html>
