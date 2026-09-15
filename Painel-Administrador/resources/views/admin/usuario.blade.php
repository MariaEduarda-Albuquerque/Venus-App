@extends('layouts.dashboard')
@section('title', 'Usuários')

@section('content')
<style>
    .card-container {
        background: #ffffff;
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        font-family: Arial, sans-serif;
        margin-top: 50px;
        width: 100%;
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .search-box {
        position: relative;
        width: 300px;
    }

    .search-box input {
        width: 100%;
        padding: 10px 14px 10px 38px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        background-color: #f9fafb;
        font-size: 14px;
        color: #374151;
        outline: none;
    }

    .search-box svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        fill: #9ca3af;
    }

    .btn-filter {
        background: #f3f4f6;
        border: 1px solid #d1d5db;
        color: #800020;
        padding: 8px 24px;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        font-size: 16px;
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
</style>

<div class="card-container">
    <div class="toolbar">
        <div class="search-box">
            <svg viewBox="0 0 24 24">
                <path d="M10 2a8 8 0 015.29 13.71l4.5 4.49-1.42 1.42-4.49-4.5A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z"/>
            </svg>
            <input type="text" placeholder="Pesquisar...">
        </div>
        <button class="btn-filter">Filtro</button>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL CADASTRADO</th>
                <th>DATA CADASTRO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->idUsuario ?? $usuario->id }}</td>
                    <td>{{ $usuario->nomeUsuario }}</td>
                    <td>{{ $usuario->emailUsuario}}</td>
                    <td>{{ isset($usuario->created_at) ? $usuario->created_at->format('d/m/Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection