<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Conteúdo | Vênus</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/relatorio-conteudo.css') }}">
</head>

<body class="rl-pdf-body">
    <div class="rl-pdf">

        <div class="rl-pdf-barra">
            <span>Use Ctrl+P (ou o botão ao lado) para salvar como PDF.</span>
            <button type="button" class="btn-primary-sm" onclick="window.print()">Imprimir / Salvar PDF</button>
        </div>

        <div class="rl-pdf-topo">
            <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus">
            <div>
                <h1>Relatório de Conteúdo</h1>
                <p>{{ $profissional->nomeProfissionalSaude ?? '' }}</p>
                <p>{{ $periodoTexto }} · Gerado em {{ $geradoEm }}</p>
            </div>
        </div>

        @include('painelProfissional.relatorio-corpo')
    </div>
</body>

</html>
