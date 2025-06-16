<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Certificado</title>
    <style>
        @font-face {
            font-family: gyre;
            src: url('{{ public_path('fonts/tex-gyre-termes/texgyretermes-regular.otf') }}');
        }

        * {
            margin: 0;
            padding: 0;
            font-family: gyre;
        }

        body {
            background-image: url('{{ $imagem }}');
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            position: relative;
        }

        .texto_certificado {
            font-size: {{ $tamanho_fonte }}px;
            color: #000000;
            margin-top: 420px;
            margin-left: 100px;
            margin-right: 100px;
            text-align: justify;
        }

        .data_local {
            margin-top: 30px;
            font-size: 32px;
            text-align: center;
        }

        .verso_page {
            page-break-before: always;
            background-image: url('{{ $verso }}');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .texto_verso_superior {
            font-size: 24px;
            font-weight: bold;
            margin-top: 240px;
            margin-left: 60px;
            margin-right: 60px;
            text-align: center;
        }

        .texto_verso_inferior {
            font-size: 24px;
            margin-top: 30px;
            margin-left: 60px;
            margin-right: 60px;
            text-align: center;
        }

        .codigo_validacao {
            font-size: 18px;
            margin-top: 20px;
            text-align: center;
        }

        .qrcode {
            margin-top: 40px;
            text-align: center;
        }

        .qrcode img {
            height: 150px;
        }
    </style>
</head>
<body>
    <div class="texto_certificado">
        {!! $modelo->texto !!}
    </div>

    <div class="data_local">
        Garanhuns, {{ $data_atual }}
    </div>

    <div class="verso_page">
        <div class="texto_verso_superior">
            Para verificar a autenticidade deste certificado, acesse o Código QR abaixo:
        </div>

        <div class="qrcode">
            <img src="data:image/svg+xml;base64,{{ $qrcode }}" alt="QR Code">
        </div>

        <div class="texto_verso_inferior">
            Ou digite este código de verificação de autenticidade no endereço:<br>
            <a href="http://certifica.ufape.edu.br/validacao">http://certifica.ufape.edu.br/validacao</a>
        </div>

        <div class="codigo_validacao">
            <strong>Código de verificação de autenticidade:</strong><br>
            {{ $certificado->codigo_validacao }}
        </div>
    </div>
</body>
</html>
