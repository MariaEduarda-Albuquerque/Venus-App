<script>
    window.RELATORIO = {
    titulo: 'Relatório de atendimento',
    arquivo: 'relatorio-atendimento',
    periodo: true,
    rotulos: ['Chamados atendidos', 'Canal mais usado', 'Satisfação média'],
    extra: { '30': '4,6 / 5', '90': '4,5 / 5', '365': '4,4 / 5' },
    graficos: [
        { t: 'Canais de atendimento', s: 'Por onde as usuárias nos procuram', rosa: false,
          d: {
            '30':  [['Chat', 420],  ['E-mail', 260],  ['Formulário', 180], ['Telefone', 90]],
            '90':  [['Chat', 1150], ['E-mail', 940],  ['Formulário', 410], ['Telefone', 260]],
            '365': [['E-mail', 4200], ['Chat', 3900], ['Formulário', 1500], ['Telefone', 1210]]
          } },
        { t: 'Motivos dos chamados', s: 'Assuntos mais comuns', rosa: true,
          d: {
            '30':  [['Dúvidas de uso', 310], ['Acesso e senha', 240], ['Erros técnicos', 170], ['Conta e dados', 130], ['Sugestões', 100]],
            '90':  [['Acesso e senha', 820], ['Dúvidas de uso', 760], ['Erros técnicos', 390], ['Conta e dados', 300], ['Sugestões', 280]],
            '365': [['Dúvidas de uso', 3100], ['Acesso e senha', 2900], ['Erros técnicos', 1800], ['Conta e dados', 1200], ['Sugestões', 1000]]
          } },
        { t: 'Satisfação com o atendimento', s: 'Avaliações recebidas', rosa: false,
          d: {
            '30':  [['Muito satisfeita', 520], ['Satisfeita', 300], ['Neutra', 90],  ['Insatisfeita', 40]],
            '90':  [['Muito satisfeita', 1400], ['Satisfeita', 880], ['Neutra', 310], ['Insatisfeita', 120]],
            '365': [['Muito satisfeita', 5200], ['Satisfeita', 3600], ['Neutra', 1300], ['Insatisfeita', 700]]
          } }
    ]
};
</script>