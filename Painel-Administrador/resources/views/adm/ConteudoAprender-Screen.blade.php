<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @include('layouts.sidebar')

    <style>
    .card-container {
        background: #ffffff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        font-family: Arial, sans-serif;
        margin-top: 50px;
        width: 90%;
    }

    h1{
        font-size: 30px;
        color: rgb(170, 27, 49);
        font-family: Arial, Helvetica, sans-serif;
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        color: #90192d;
    }

    .search-box {
        position: relative;
        width: 300px;
        color: #90192d;
    }

    .search-box input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background-color: #f9fafb;
        color: #90192d;
        font-size: 14px;
        color: #90192d;
        outline: none;
    }

    .search-box svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        fill: #90192d;
    }

    .btn-filter {
        background: #800020;
        border: 1px solid #d1d5db;
        color: white;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        font-size: 16px;
    }

    .filtro{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 5px;

        padding: 4px 14px;
        background: #800020;
        border: 1px solid #d1d5db;
        color: white;
        
        border-radius: 10px;
        font-weight: 500;
        cursor: pointer;
        font-size: 16px;
    }

    .filtro h2{
        font-size: 15px;
    }

    .filtro img{
        width: 25px;
        height: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table th {
        background-color: #90192d;
        color: #ffffff;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.5px;
        padding: 14px 16px;
        text-align: center;
    }

    .custom-table th:first-child {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }

    .custom-table th:last-child {
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
    }

    .custom-table td {
        padding: 18px 16px;
        text-align: center;
        color: #6b7280;
        font-size: 14px;
        border-bottom: 1px solid #e5e7eb;
    }

    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-ativo {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-desativado {
        background-color: #fceeec;
        color: #991b1b;
    }

    .pesquisa-filtro{
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: flex-end;
        gap: 67px;
    }
</style>

    <div class="direita">
            <div class="mini-header">

            <div class="mini-header-titulo">
                <h1 class="titulo-tela">Conteúdos Aprender</h1>
            </div>

            <a href="">
                <div class="btn-miniHeader">
                    <img src="{{ asset('images/notification.png') }}" alt="">
                </div>
            </a>

            <a href="">
                <div class="btn-miniHeader">
                    <img src="{{ asset('images/perfil.png') }}" alt="">
                </div>
            </a>
        </div>

            <div class="card-container">
        <div class="toolbar">
            <h1>Conteúdos</h1>
            <div class="pesquisa-filtro">
            <div class="search-box">
                <svg viewBox="0 0 24 24">
                    <path d="M10 2a8 8 0 015.29 13.71l4.5 4.49-1.42 1.42-4.49-4.5A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
                </svg>
                <input type="text" placeholder="Pesquisar...">
            </div>
                <div class="filtro">
                    <img src="{{ asset('images/filtro.png') }}" alt="">
                    <h2>Filtro</h2>
                </div>
            </div>
        </div>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Corpo</th>
                    <th>DATA CADASTRO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Conteudos as $conteudo)
                    <tr>
                        <td>{{ $conteudo->idConteudo ?? $conteudo->id }}</td>
                        <td>{{ $conteudo->tituloConteudo }}</td>
                        <td>{{ $conteudo->corpoConteudo}}</td>
                        <td>{{ isset($conteudo->created_at) ? $conteudo->created_at->format('d/m/Y') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

</body>
</html>