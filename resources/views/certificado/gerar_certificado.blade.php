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
                font-size: 50px;
                color: #000000;
                text-shadow: 4px 4px #000;
                margin-top: 550px;
                margin-left: 600px;
                margin-right: 250px;
                text-align: justify;
            }

            .codigo_validacao {
                font-size: 32px;
                width:28%;
                margin-left:1500px;
                margin-top: 40px;
            }

            .qrcode {
                height: 25%;
                margin-top: 40px;
                margin-left: 1320px;
            }


            .texto_verso_superior{
                font-size:32px;
                width:28%;
                font-weight:bold;
                margin-left:1500px;
                margin-top: 320px;

            }

            .texto_verso_inferior{
                font-size:32px;
                width:28%;
                margin-left:1500px;
                margin-top: 40px;
            }

            .logo {
                margin-right: 200;
                margin-top: 200;
            }

        </style>
    </head>

    <body class="fundo_certificado">
        <p class="texto_certificado">
            {{ $modelo->texto }}

            <br> <br> <br>

            <div style="text-align: center; font-size: 50px; margin-left: 400px; "> Garanhuns, {{ $data_atual }} </div>
        </p>
    </body>

    <body class="verso_certificado">
                <p class='texto_verso_superior'>Para verificar a autenticidade deste certificado, acesse o Código QR abaixo: </p>

                <img class="qrcode" src="data:image/png;base64, {{ $qrcode }}">

                <p class='texto_verso_inferior'>Ou digite este código de verificação de autenticidade no endereço <a href="http://certifica.ufape.edu.br/validacao">http://certifica.ufape.edu.br/validacao</a> </p>

                <p class='codigo_validacao'><b>Código de verificação de autenticidade:</b><br>{{ $certificado->codigo_validacao }}</p>

    </body>
</html>
