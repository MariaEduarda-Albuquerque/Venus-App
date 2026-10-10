<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Painel Administrativo - Vênus')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@0.469.0/dist/umd/lucide.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/sidebar-pesquisa.css') }}">
    @stack('css')
</head>
<body>

    @include('layouts.sidebar')

    <div class="direita">
        @include('layouts.barra-pesquisa')
        @yield('content')
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
    @stack('scripts')
    <script>lucide.createIcons();</script>

</body>
</html>