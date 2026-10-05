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
                <div class="etapa-atual">
                    <div class="numero-etapa"><h2>3</h2></div>
                    <p>Materiais e divulgação</p>
                </div>
                <hr class="divisor-etapa">
                <div class="etapa">
                    <div class="numero-etapa"><h2>4</h2></div>
                    <p>Revisão e publicação</p>
                </div>
            </div>
        </div>

        <form class="form-criar" action="">
            <div class="container-1">
            
                <div class="titulo-subtitulo">
                    <h1>Materiais e divulgação</h1>
                    <p>Difina as informações e mensagens que serão compartilhadas.</p>
                </div>

                <div class="principal-destaque-container">
                    <div class="titulo-input">
                    <div class="titulo-input-com-info">
                        <label>Peça principal do destaque<span class="asterisco">*</span></label>
                        <a href="">
                            <p class="informativo">i</p>
                        </a>
                    </div>
                    </div>

                    <div class="cartaz-principal">
                        <img src="{{ asset('images/img-destaque.png') }}" alt="">

                        <div class="direita-cartaz-principal">
                            <h2>Cartaz principal.png</h2>
                            <p>Banner <span class="bolinha">•</span> 1080 x 1350px <span class="bolinha">•</span> 1.2MB</p>
                            <div class="enviado">
                                <img src="{{asset('images/check-circle.png')}}" alt="">
                                <p>Enviado com sucesso</p>
                            </div>

                        <div class="substituir-imagem">
                            <input type="file" id="imagem" accept="image/*">
                            <label for="imagem">
                                <img src="{{asset('images/repeat-alt.png')}}" alt="">
                                Substituir
                            </label>
                        </div>

                    </div>

                    </div>

                    <div class="materiais-complementares">
                        <label for="">Materiais complementares</label>

                        <div class="bloco-materiais">
                            <div class="material">
                                <img src="{{asset('images/image.png')}}" alt="">
                                <div class="text-material">
                                    <h2>Card - Formas de prevencao.png</h2>
                                    <p>Imagem<span class="bolinha">•</span>1080 x 1080px<span class="bolinha">•</span>842KB</p>
                                </div>
                                <img src="{{asset('images/tres-pts.png')}}" alt="">
                            </div>
                            <div class="material">
                                <img src="{{asset('images/file-detail-red.png')}}" alt="">
                                <div class="text-material">
                                    <h2>Infográfico - Sintomas de alerta.png</h2>
                                    <p>Imagem<span class="bolinha">•</span>1080 x 1920px<span class="bolinha">•</span>1.1MB</p>
                                </div>
                                <img src="{{asset('images/tres-pts.png')}}" alt="">
                            </div>
                        </div>

                        <div class="bloco-materiais">
                            <div class="material">
                                <img src="{{asset('images/file-detail-red.png')}}" alt="">
                                <div class="text-material">
                                    <h2>Folder - Onde buscar ajuda.pdf</h2>
                                    <p>PDF<span class="bolinha">•</span>2 páginas<span class="bolinha">•</span>1.8MB</p>
                                </div>
                                <img src="{{asset('images/tres-pts.png')}}" alt="">
                            </div>
                            <div class="material">
                                <img src="{{asset('images/headphone-mic-red.png')}}" alt="">
                                <div class="text-material">
                                    <h2>Aúdio - Fale sobre prevenção.mp3</h2>
                                    <p>Áudio<span class="bolinha">•</span>2:34min<span class="bolinha">•</span>2.4MB</p>
                                </div>
                                <img src="{{asset('images/tres-pts.png')}}" alt="">
                            </div>
                        </div>

                        <div class="adicionar-materiais-btn">
                            <input type="file" id="materiais" multiple>
                            
                            <label for="materiais">
                                <span class="mais">+</span>
                                Adicione mais materiais
                            </label>
                        </div>
                    </div>
                </div>

                <div class="btn-continuar-pt2-em-diante">
                    <!-- <button class="button">
                        <h2>Continuar</h2>
                        <img src="{{ asset('images/continuar.png') }}" alt="">
                    </button> -->

                    <!-- Mudar para Button quando o form estiver funcional -->

                    <a class="button-voltar" href="/criar-destaque-pt2">
                        <img src="{{asset('images/voltar-vermelho.png')}}" alt="">
                        <h2>Voltar</h2>
                    </a>

                    <a class="button" href="/criar-destaque-pt4">
                        <h2>Continuar</h2>
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