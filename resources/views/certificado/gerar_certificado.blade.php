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
                text-align: justify;
            }

            .codigo_validacao {
                font-size: 16px;
                width:28%;
                margin-left:750px;
                margin-top: 20px;
            }

            .qrcode {
                height: 25%;
                margin-top: 20px;
                margin-left: 680px;
            }


            .texto_verso_superior{
                font-size:16px;
                width:28%;
                font-weight:bold;
                margin-left:750px;
                margin-top: 90px;

            }

            .texto_verso_inferior{
                font-size:16px;
                width:28%;
                margin-left:750px;
                margin-top: 20px;
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

            Garanhuns, {{ $data_atual }}
        </p>
    </body>
    
    <body class="verso_certificado">
                <p class='texto_verso_superior'>Para verificar a validade deste certificado, acesse o Código QR abaixo: </p>

                <img class="qrcode" src="data:image/png;base64, {{ $qrcode }}">
                
                <p class='texto_verso_inferior'>Ou digite este código de validação no endereço <a href="http://certifica.ufape.edu.br/validacao">certifica.ufape.edu.br/validacao</a> </p>
                
                <p class='codigo_validacao'><b>Código de validação:</b><br>{{ $certificado->codigo_validacao }}</p>
                
    </body>
</html>
