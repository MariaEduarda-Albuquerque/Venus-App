<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destaques principais</title>
    <link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">
        @include('layouts.barra-pesquisa')

        <div class="topo-pagina">
            <h1>Destaques - principal</h1>
            <a href="/criar-destaque" class="btn-criar">
                <img src="{{ asset('images/plus.png') }}" alt="">
                <h2>Criar</h2>
            </a>
        </div>

        <div class="container-destaques-navegar">
            <div class="container-destaque">
                <div class="parte-1-destaque">
                    <div class="esquerda-pt-1">
                        <div class="topo-pt-1">
                            <h1>Proteja-se: ISTs podem ser prevenidas</h1>
                            <p>Confira aqui todos os detalhes antes de publicar</p>
                        </div>
                        <div class="abaixo-pt-1">
                            <h2>Informações básicas</h2>
                            <p><span class="palavra-destaque-texto">Título: </span>Proteja-se: ISTs podem ser prevenidas!</p>
                            <p><span class="palavra-destaque-texto">Objetivo: </span>Conscientizar sobre as infecções Sexualmente Transmissíveis, suas formas de prevenção, sintomas e a importância do diagnóstico precoce.</p>
                            <p><span class="palavra-destaque-texto">Público-alvo: </span>Adolescentes e jovens (14 a 25)</p>
                            <p><span class="palavra-destaque-texto">Categoria: </span>ISTs (Infecções Sexualmente ...)</p>
                            <p><span class="palavra-destaque-texto">Período: </span>01/07/2025 a 31/07/2025</p>
                        </div>
                    </div>
                    <div class="img-destaque">
                        <img src="{{ asset('images/img-destaque.png') }}" alt="">
                    </div>
                </div>

                    <div class="parte-2-destaque">
                        <h2>Conteúdo do destaque</h2>
                        <div class="conteudo-pt-2">
                            <div class="bloco">
                                <p><span class="palavra-destaque-texto">Mensagem principal: </span>Proteja-se: ISTs podem ser ...!</p>
                                <p><span class="palavra-destaque-texto">Texto de apresentação: </span>As infecções Sexualmente Transmissíveis (ISTs) são comuns, mas podem ser prevenidas e atitutes responsáveis. Cuidar da sua saúde é um ato de amor com você e com o outro.</p>
                            </div>
                            <div class="bloco">
                                <p><span class="palavra-destaque-texto">CTA: </span>Faça o teste, use camisinha e converse sobre saúde sexual.</p>
                                <p><span class="palavra-destaque-texto">Fontes: </span>Ministério da saúde, OMS e UNAIDS.</p>
                            </div>
                            <div class="bloco">
                                <h2>Materiais e divulgação</h2>
                                <p><span class="palavra-destaque-texto">Principal: </span>Cartaz principal.png</p>
                                <p><span class="palavra-destaque-texto">Outros: </span>Card. png, folder.pdf, infografico.png, audio.mp3</p>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="container-destaque">
                <div class="parte-1-destaque">
                    <div class="esquerda-pt-1">
                        <div class="topo-pt-1">
                            <h1>Proteja-se: ISTs podem ser prevenidas</h1>
                            <p>Confira aqui todos os detalhes antes de publicar</p>
                        </div>
                        <div class="abaixo-pt-1">
                            <h2>Informações básicas</h2>
                            <p><span class="palavra-destaque-texto">Título: </span>Proteja-se: ISTs podem ser prevenidas!</p>
                            <p><span class="palavra-destaque-texto">Objetivo: </span>Conscientizar sobre as infecções Sexualmente Transmissíveis, suas formas de prevenção, sintomas e a importância do diagnóstico precoce.</p>
                            <p><span class="palavra-destaque-texto">Público-alvo: </span>Adolescentes e jovens (14 a 25)</p>
                            <p><span class="palavra-destaque-texto">Categoria: </span>ISTs (Infecções Sexualmente ...)</p>
                            <p><span class="palavra-destaque-texto">Período: </span>01/07/2025 a 31/07/2025</p>
                        </div>
                    </div>
                    <div class="img-destaque">
                        <img src="{{ asset('images/img-destaque.png') }}" alt="">
                    </div>
                </div>

                <div class="parte-2-destaque">
                    <h2>Conteúdo do destaque</h2>
                    <div class="conteudo-pt-2">
                        <div class="bloco">
                            <p><span class="palavra-destaque-texto">Mensagem principal: </span>Proteja-se: ISTs podem ser ...!</p>
                            <p><span class="palavra-destaque-texto">Texto de apresentação: </span>As infecções Sexualmente Transmissíveis (ISTs) são comuns, mas podem ser prevenidas e atitutes responsáveis. Cuidar da sua saúde é um ato de amor com você e com o outro.</p>
                        </div>
                        <div class="bloco">
                            <p><span class="palavra-destaque-texto">CTA: </span>Faça o teste, use camisinha e converse sobre saúde sexual.</p>
                            <p><span class="palavra-destaque-texto">Fontes: </span>Ministério da saúde, OMS e UNAIDS.</p>
                        </div>
                        <div class="bloco">
                            <h2>Materiais e divulgação</h2>
                            <p><span class="palavra-destaque-texto">Principal: </span>Cartaz principal.png</p>
                            <p><span class="palavra-destaque-texto">Outros: </span>Card. png, folder.pdf, infografico.png, audio.mp3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>