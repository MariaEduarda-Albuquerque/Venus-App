<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termos de Uso | Vênus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; background: #fdf3f1; color: #3a2530; line-height: 1.7; }
        .termos-wrap { max-width: 820px; margin: 0 auto; padding: 40px 20px 60px; }
        .termos-topo { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; gap: 12px; flex-wrap: wrap; }
        .termos-topo img { height: 44px; }
        .termos-voltar { color: #9E182B; font-size: 14px; font-weight: 600; text-decoration: none; }
        .termos-voltar:hover { text-decoration: underline; }
        .termos-card { background: #fff; border-radius: 14px; padding: 36px 40px; box-shadow: 0 4px 24px rgba(58, 37, 48, 0.08); }
        h1 { font-size: 26px; color: #9E182B; margin-bottom: 4px; }
        .termos-data { font-size: 13px; color: #7a6670; margin-bottom: 24px; }
        h2 { font-size: 17px; color: #9E182B; margin: 26px 0 8px; }
        p, li { font-size: 14.5px; }
        p { margin-bottom: 10px; }
        ul { margin: 0 0 10px 22px; }
        @media (max-width: 600px) { .termos-card { padding: 24px 20px; } }
    </style>
</head>

<body>
    <div class="termos-wrap">
        <div class="termos-topo">
            <img src="{{ asset('images/logoVenus.png') }}" alt="Vênus">
            <a href="javascript:window.close()" class="termos-voltar" onclick="if (history.length > 1 && !window.opener) { history.back(); return false; }">&larr; Voltar</a>
        </div>

        <main class="termos-card">
            <h1>Termos de Uso</h1>
            <p class="termos-data">Última atualização: {{ now()->format('d/m/Y') }}</p>

            <p>Bem-vindo(a) à Vênus. Ao criar uma conta no Painel do Profissional, você declara que leu e concorda com os termos abaixo.</p>

            <h2>1. Sobre a plataforma</h2>
            <p>A Vênus é uma plataforma que conecta profissionais de saúde a usuárias, oferecendo atendimento por chat, dúvidas rápidas, consultas, publicação de conteúdos educativos e ferramentas de gestão de agenda.</p>

            <h2>2. Cadastro e veracidade das informações</h2>
            <ul>
                <li>Você deve fornecer informações verdadeiras, completas e atualizadas, incluindo CPF/CNPJ e documentos de conselho de classe.</li>
                <li>Todo cadastro passa por análise e validação por um administrador antes da liberação do acesso.</li>
                <li>Você é responsável por manter a confidencialidade da sua senha e por toda atividade realizada na sua conta.</li>
            </ul>

            <h2>3. Conduta do profissional</h2>
            <ul>
                <li>Exercer a profissão conforme o código de ética e as normas do seu conselho de classe.</li>
                <li>Tratar as usuárias com respeito, sigilo e profissionalismo.</li>
                <li>Não utilizar a plataforma para fins ilícitos, discriminatórios ou para divulgar conteúdo enganoso.</li>
                <li>Não oferecer ou divulgar produtos, serviços ou tratamentos sem respaldo técnico-científico.</li>
            </ul>

            <h2>4. Conteúdos publicados</h2>
            <p>Os conteúdos enviados por você são de sua responsabilidade e podem passar por revisão antes da publicação. A Vênus pode recusar ou remover conteúdos que violem estes termos ou a legislação vigente.</p>

            <h2>5. Atendimento e limitações</h2>
            <p>A plataforma é uma ferramenta de apoio e não substitui atendimento de urgência ou emergência. Em casos graves, a usuária deve ser orientada a procurar atendimento presencial imediato.</p>

            <h2>6. Privacidade e proteção de dados</h2>
            <p>Os dados pessoais são tratados conforme a Lei Geral de Proteção de Dados (Lei nº 13.709/2018) e a Política de Privacidade da Vênus. As informações de usuárias a que você tiver acesso devem ser usadas exclusivamente para a finalidade do atendimento, mantendo o sigilo profissional.</p>

            <h2>7. Suspensão e exclusão da conta</h2>
            <p>A Vênus pode suspender ou encerrar contas que descumprirem estes termos. Você também pode excluir a sua conta a qualquer momento em <strong>Configurações &gt; Zona de Risco</strong>. A exclusão é permanente e remove os dados associados à sua conta.</p>

            <h2>8. Alterações nos termos</h2>
            <p>Estes termos podem ser atualizados periodicamente. O uso continuado da plataforma após as alterações representa a concordância com a nova versão.</p>

            <h2>9. Contato</h2>
            <p>Em caso de dúvidas, entre em contato pela página de suporte do painel.</p>
        </main>
    </div>
</body>

</html>
