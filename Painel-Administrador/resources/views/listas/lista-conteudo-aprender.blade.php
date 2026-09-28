<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Conteúdos Aprender</title>
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
</head>
<body>
    @include('layouts.sidebar')

    <div class="direita">

        @include('layouts.mini-header', [
            'titulo' => 'Conteúdos Aprender'
        ])
        <div class="container-global">
            <div class="cards-inicio">
                <div class="card-inicio">
                    <img src="{{ asset('images/alert-triangle.png') }}" alt="">
                    <div class="textos-card-inicio">
                        <h1>1</h1>
                        <p>Recusados</p>
                    </div>
                </div>

                <div class="card-inicio">
                    <img class="img-2" src="{{asset('images/tempo.png')}}" alt="">
                    <div class="textos-card-inicio">
                        <h1>2</h1>
                        <p>Aguardando revisão</p>
                    </div>
                </div>

                <div class="card-inicio">
                    <img class="img-3" src="{{ asset('images/check-circle.png') }}" alt="">
                    <div class="textos-card-inicio">
                        <h1>1</h1>
                        <p>Publicados</p>
                    </div>
                </div>
            </div>

        <div class="lista">

            <div class="header-tabela">

                <h1>Conteúdos</h1>

                <div class="isolar">
                    <form action="">
                        <button>
                            <img src="{{ asset('images/lupa.png') }}" alt="">
                        </button>
                        <input type="text" placeholder="Pesquisar...">
                    </form>

                    <div class="container-filtro">
                        <div class="btn-filtro" onclick="abrirMenuFiltros()">
                            <img src="{{ asset('images/filtro.png') }}" alt="">
                            <h2>Filtro</h2>
                        </div>

                        <div class="filtro-menu" id="filtro-menu">
                            <ul>
                                <li>
                                    <a href="">Todos</a>
                                </li>
                                <li>
                                    <a href="">Publicado</a>
                                </li>
                                <li>
                                    <a href="">Em Análise</a>
                                </li>
                                <li>
                                    <a href="">Recusado</a>
                                </li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

            <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profissional</th>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr onclick="abrirModal()" id="conteudo" name="conteudo">
                        <td>CO000006</td>
                        <td>RobertaOli@gmail.com</td>
                        <td>O que são ISTs, como identificar e tratar</td>
                        <td>27/07/2026</td>
                        <td><span class="status-amarelo">Em Análise</span></td>
                    </tr>

                    <tr onclick="abrirModal()" id="conteudo" name="conteudo">
                        <td>CO000005</td>
                        <td>RicardoN@gmail.com</td>
                        <td>Como achar campanhas de vacinações por perto</td>
                        <td>06/07/2026</td>
                        <td><span class="status-amarelo">Em Análise</span></td>
                    </tr>

                    <tr onclick="abrirModal()" id="conteudo" name="conteudo">
                        <td>CO000004</td>
                        <td>AlineSP@gmail.com</td>
                        <td>Entenda como lidar com os efeitos de uma IST</td>
                        <td>13/06/2026</td>
                        <td><span class="status-verde">Publicado</span></td>
                    </tr>

                    <tr onclick="abrirModal()" id="conteudo" name="conteudo">
                        <td>CO000002</td>
                        <td>JuniorCOR@gmail.com</td>
                        <td>Muito legal meu dia ontem</td>
                        <td>11/05/2026</td>
                        <td><span class="status-vermelho">Recusado</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal-overlay" id="modal-overlay" name="modal-overlay">
            <div class="modal-conteudo" id="modal-conteudo" name="modal-conteudo">
                <div class="topo">
                    <div class="topo-esquerda">
                        <div class="foto-perfil">
                            <h1>R</h1>
                        </div>
                        <div class="nome-status">
                            <h1>Roberta Oliveira</h1>
                            <p class="status-verde">Ativa</p>
                        </div>
                    </div>
                    <a class="fechar" onclick="fecharModal()">
                        <h2>x</h2>
                    </a>
                </div>

                <hr class="divisor">

                <div class="titulo-conteudo">
                    <h1>ID do conteúdo</h1>
                    <p>CO000006</p>
                </div>

                <hr class="divisor">

                <div class="titulo-conteudo">
                    <h1>Titulo do conteúdo</h1>
                    <p>O que são ISTs, como identificar e tratar</p>
                </div>

                <hr class="divisor">

                <div class="container-btn-conteudo">
                    <a onclick="abrirModalCompleto()" class="btn-conteudo-completo" >
                        <h2>Ver conteúdo</h2>
                    </a>
                </div>

                <div class="aprovar-recusar">
                    <a class="btn-aprovar" href="">
                        <h2>Aprovar</h2>
                    </a>

                    <a class="btn-recusar" href="">
                        <h2>Recusar</h2>
                    </a>
                </div>

            </div>
        </div>

        <div class="modal-overlay-2" id="modal-overlay-2" name="modal-overlay-2" onclick="fecharConteudoCompleto()">
            <div class="modal-conteudo-completo" id="modal-conteudo-completo">
            <div class="topo-completo">
                <div class="topo-esquerda-completo">
                    <h1>O que são ISTs?</h1>
                    <p>As infecções Sexualmente Transmissíveis (ISTs) são causadas por vírus, bactérias ou outros micro-organismos transmitidos principalemnte pelo contato sexual. Mas existem formas simples de se proteger - e esse artigo vai te mostrar tudo.</p>
                </div>

                <div class="container-profissional">
                    <div class="perfil">
                        <img src="{{ asset('images/user-preto.png') }}" alt="">
                    </div>
                    <div class="nome-cargo-profissional">
                        <h2>Dra. Roberta Oliveira</h2>
                        <h2>Ginecologista - 27/07/2026</h2>
                    </div>
                </div>
            </div>

            <div class="meio">
                <div class="meio-esquerda">
                    <h1>Principais tipos de ISTs</h1>

                    <div class="card">
                        <div class="imagem-card">
                            <div class="circulo-com-borda-preta"></div>
                        </div>
                        <div class="conteudo-card">
                            <h1>HIV/ AIDS</h1>
                            <p>Virus que afeta o sistema imonológico
                            Com tratamento a pessoa vive com qualidade
                            de vida normal</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="imagem-card">
                            <div class="circulo-com-borda-preta"></div>
                        </div>
                        <div class="conteudo-card">
                            <h1>Sífilis</h1>
                            <p>Virus que afeta o sistema imonológico
                            Com tratamento a pessoa vive com qualidade
                            de vida normal</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="imagem-card">
                            <div class="circulo-com-borda-preta"></div>
                        </div>
                        <div class="conteudo-card">
                            <h1>Gonorreia e Clamídia</h1>
                            <p>Virus que afeta o sistema imonológico
                            Com tratamento a pessoa vive com qualidade
                            de vida normal</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="imagem-card">
                            <div class="circulo-com-borda-preta"></div>
                        </div>
                        <div class="conteudo-card">
                            <h1>HPV</h1>
                            <p>Virus que afeta o sistema imonológico
                            Com tratamento a pessoa vive com qualidade
                            de vida normal</p>
                        </div>
                    </div>
                </div>

                <div class="meio-direita">
                    <img src="{{ asset('images/img-conteudo.png') }}" alt="">
                </div>
            </div>

            <div class="abaixo">
                <h1>Como me proteger?</h1>
                <div class="card">
                    <div class="imagem-card">
                        <div class="circulo-com-borda-preta"></div>
                    </div>
                    <div class="conteudo-card">
                        <h1>Use camisinha sempre</h1>
                        <p> Ela é o único método que protege contra ISTs e gravidez acidental ao mesmo tempo. É gratuita nos postos do SUS.</p>
                    </div>
                </div>

                <div class="card">
                    <div class="imagem-card">
                        <div class="circulo-com-borda-preta"></div>
                    </div>
                    <div class="conteudo-card">
                        <h1>Faça exames regulares</h1>
                        <p>O Papanicolau e os testes rápidos de IST são gratuitos no SUS. Exame de rotina salva vidas.</p>
                    </div>
                </div>

                <div class="card">
                    <div class="imagem-card">
                        <div class="circulo-com-borda-preta"></div>
                    </div>
                    <div class="conteudo-card">
                        <h1>Tome a vacina contra HPV</h1>
                        <p>Disponível gratuitamente no SUS para meninas de 9 a 14 anos. Se você ainda não tomou, corra ao posto!</p>
                    </div>
                </div>
            </div>

            <div class="fontes">
                <h1>Fontes consultadas</h1>
                <div class="bloco-fontes">
                    <p>Ministério da Saúde - saude.gov.br. 2024</p>
                    <p>OMS - Organizaão Mundial da Saúde, 2023 </p>
                </div>
                <div class="bloco-fontes">
                    <p>Febrasgo - Federação Brasileira de Ginecologia, 2024</p>
                    <p>UNAIDS Brasil - unaids.org.br</p>
                </div>
            </div>
        </div>
    </div>

        
    </div>

    <script src="{{ asset('js/adm.js') }}"></script>
</body>
</html>