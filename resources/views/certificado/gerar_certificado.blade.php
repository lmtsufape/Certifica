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
                padding-top: 75px;
            }

            .verso_certificado {
                background-image: url( {{ public_path($verso) }});
                background-size: cover;
                font-family: Arial, sans-serif;
                text-align: center;
                padding-top: 75px;
            }

            .texto_certificado {
                font-size: {{ $tamanho_fonte }}px;
                color: #000000;
                text-shadow: 4px 4px #000;
                margin-top: 412px;
                margin-left: 450px;
                margin-right: 187px;
                text-align: justify;
                text-justify: inter-word;
            }

            .codigo_validacao {
                font-size: 24px;
                width:28%;
                margin-left:1180px;
                margin-top: 30px;
            }

            .qrcode {
                height: 25%;
                margin-top: 30px;
                margin-left: 1100px;
            }


            .texto_verso_superior{
                font-size:24px;
                width:28%;
                font-weight:bold;
                margin-left:1180px;
                margin-top: 240px;

            }

            .texto_verso_inferior{
                font-size:24px;
                width:28%;
                margin-left:1180px;
                margin-top: 30px;
            }

            .logo {
                height: 100px;
                width: 150px;
            }

        </style>
    </head>

    <body class="fundo_certificado">
        <p class="texto_certificado">
            {!! $modelo->texto !!}

            <br> <br> <br>

            <div style="text-align: center; font-size: 38px; margin-left: 300px; "> Garanhuns, {{ $data_atual }} </div>
        </p>
    </body>

    <body class="verso_certificado">
                <p class='texto_verso_superior'>Para verificar a autenticidade deste certificado, acesse o Código QR abaixo: </p>

                <img class="qrcode" src="data:image/png;base64, {{ $qrcode }}">

                <img class="logo" src="{{ public_path($logo) }}" alt="Logo">

                <p class='texto_verso_inferior'>Ou digite este código de verificação de autenticidade no endereço <a href="http://certifica.ufape.edu.br/validacao">http://certifica.ufape.edu.br/validacao</a> </p>
                
                <p class='codigo_validacao'><b>Código de verificação de autenticidade:</b><br>{{ $certificado->codigo_validacao }}</p>

    </body>
</html>
