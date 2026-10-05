<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar destaque</title>
    <link rel="stylesheet" href="{{ asset('css/destaque.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">
        @include('layouts.barra-pesquisa')

        <div class="topo-pagina-criar">
            <h1>Destaques</h1>
            <div class="etapas">
                <div class="etapa-concluida">
                    <div class="etapa-numero-concluida"><img src="{{asset('images/check.png')}}" alt=""></div>
                    <p>Informações básicas</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa-concluida">
                    <div class="etapa-numero-concluida"><img src="{{asset('images/check.png')}}" alt=""></div>
                    <p>Conteúdo do destaque</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa-concluida">
                    <div class="etapa-numero-concluida"><img src="{{asset('images/check.png')}}" alt=""></div>
                    <p>Materiais e divulgação</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa-atual">
                    <div class="numero-etapa"><h2>4</h2></div>
                    <p>Revisão e publicação</p>
                </div>
            </div>
        </div>

        <form class="form-criar" action="">
            <div class="container-1">
            
                <div class="topo-revisao">
                    <div class="titulo-subtitulo">
                        <h1>Resumo do destaque</h1>
                        <p>Confira aqui todos os detalhes antes de publicar</p>
                    </div>
                    <div class="btn-editar">
                        <img src="{{ asset('images/editar-2.png')}}" alt="">
                        <h2>Editar</h2>
                    </div>
                </div>

                <div class="container-revisao">
                    <div class="bloco-revisao">
                        <h1>Informações básicas</h1>
                        <div class="esquerda-bloco-revisao">
                            <p><span class="palavra-destaque-texto">Título: </span>Proteja-se: ISTs podem ser prevenidas!</p>
                            <p><span class="palavra-destaque-texto">Objetivo: </span>Conscientizar sobre as infecções Sexualmente Transmissíveis, suas formas de prevenção, sintomas e a importância do diagnóstico precoce.</p>
                        </div>

                        <div class="direita-bloco-revisao">
                            <p><span class="palavra-destaque-texto">Público-alvo: </span>Adolescentes e jovens (14 a 25)</p>
                            <p><span class="palavra-destaque-texto">Categoria: </span>ISTs (Infecções Sexualmente ...)</p>
                            <p><span class="palavra-destaque-texto">Período: </span>01/07/2025 a 31/07/2025</p>
                        </div>
                    </div>
                    <hr class="divisor">
                    <div class="bloco-revisao">
                        <h1>Conteúdo do destaque</h1>
                        <div class="esquerda-bloco-revisao">
                            <p><span class="palavra-destaque-texto">Mensagem principal: </span>Proteja-se: ISTs podem ser ...!</p>
                            <p><span class="palavra-destaque-texto">Texto de apresentação: </span>As infecções Sexualmente Transmissíveis (ISTs) são comuns, mas podem ser prevenidas e atitutes responsáveis. Cuidar da sua saúde é um ato de amor com você e com o outro.</p>
                        </div>
                        <div class="direita-bloco-revisao">
                            <p><span class="palavra-destaque-texto">CTA: </span>Faça o teste, use camisinha e converse sobre saúde sexual.</p>
                            <p><span class="palavra-destaque-texto">Fontes: </span>Ministério da saúde, OMS e UNAIDS.</p>
                        </div>
                    </div>
                    <hr class="divisor">
                    <div class="bloco-revisao">
                        <h1>Materiais e divulgação</h1>
                        <div class="esquerda-bloco-revisao">
                            <p><span class="palavra-destaque-texto">Principal: </span>Cartaz principal.png</p>
                            <p><span class="palavra-destaque-texto">Outros: </span>Card. png, folder.pdf, infografico.png, audio.mp3</p>
                        </div>
                        <div class="direita-bloco-revisao">
                            <div class="img-direita-bloco-revisao">
                                <img src="{{asset('images/img-destaque.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-continuar-pt2-em-diante">
                    <!-- <button class="button">
                        <h2>Publicar</h2>
                        <img src="{{ asset('images/continuar.png') }}" alt="">
                    </button> -->

                    <!-- Mudar para Button quando o form estiver funcional -->

                    <a class="button-voltar" href="/criar-destaque-pt3">
                        <img src="{{asset('images/voltar-vermelho.png')}}" alt="">
                        <h2>Voltar</h2>
                    </a>

                    <a class="button" href="/destaques-principais">
                        <h2>Publicar</h2>
                        <img src="{{ asset('images/continuar.png') }}" alt="">
                    </a>
                </div>
            </div>

            <div class="containers-direita">
                <div class="container-2">
                    <div class="topo-container-2">
                        <h2>Prévia do destaque</h2>

                        <div class="btn-editar">
                            <img src="{{ asset('images/editar-2.png')}}" alt="">
                            <h2>Editar</h2>
                        </div>
                    </div>

                    <div class="img-criar-destaque">
                        <img src="{{ asset('images/img-destaque.png') }}" alt="">
                    </div>
                </div>

                <div class="container-3">
                    <h2>Dicas para seu destaque</h2>
                    <p>Destaques educativos ajudam a levar informção de qualidade para mulheres e jovens da nossa comunidade</p>
                    <ul>
                        <li>Use linguagem simples e acolhedora</li>
                        <li>Baseie-se em fontes confiáveis (OMS, etc..)</li>
                        <li>Inclua orientações práticas de prevenção e cuidado</li>
                        <li>Respeite a diversidade e promova a inclusão</li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</body>
</html>