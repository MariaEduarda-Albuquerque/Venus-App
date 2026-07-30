import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, Image, SafeAreaView, StatusBar } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import styles from './style';

const DIAS = [
  { label: 'Hoje', numero: '29', tipo: 'hoje' },
  { label: 'T', numero: '30', tipo: 'passado' },
  { label: 'Q', numero: '1', tipo: 'futuro' },
  { label: 'Q', numero: '2', tipo: 'futuro' },
  { label: 'S', numero: '3', tipo: 'futuro' },
  { label: 'S', numero: '4', tipo: 'futuro' },
  { label: 'D', numero: '5', tipo: 'futuro' },
];

const DICAS = [
  { titulo: 'Como você está se sentido?', botao: '', img: null },
  { titulo: 'Oscilação de humor?', botao: 'O que fazer?', img: require('../assets/humor.png') },
  { titulo: 'Ciclo desregulado?', botao: 'Veja mais', img: require('../assets/calcinha-dicas.png') },
];

const SINTOMAS = [
  { nome: 'Cólicas', img: require('../assets/colicas.png') },
  { nome: 'Mudança de humor', img: require('../assets/humor.png') },
  { nome: 'Fadiga', img: require('../assets/fadiga.png') },
];

const REGISTROS = [
  { nome: 'Gravidez', img: require('../assets/gravidez.png') },
  { nome: 'Secreção', img: require('../assets/secrecao.png') },
  { nome: 'Pílulas', img: require('../assets/pilulas.png') },
];

const CICLOS = ['30 de mar. - 26 de abr.', '27 de abr. - 8 de jun.'];

const SAUDE = [
  {
    titulo: 'Medicamentos',
    icone: 'medkit-outline',
    linha1: 'Pílula: 21h diário',
    linha2: 'Ibuprofeno: 12h/7dias',
    sino: 'notifications-outline',
  },
  {
    titulo: 'Consultas',
    icone: 'business-outline',
    linha1: 'Última: jan 2026 - Ginecologista',
    linha2: 'Próxima: jul 2026 - Dentista',
    sino: 'notifications-outline',
  },
  {
    titulo: 'Meus exames',
    icone: 'document-text-outline',
    linha1: '5 laudos salvos',
    linha2: '3 laudos analisados',
    sino: 'notifications-off-outline',
  },
];

const NAV_ITEMS = [
  { key: 'Home', img: require('../assets/tab-home.png'), tela: 'Diario' },
  { key: 'Conteúdo', img: require('../assets/tab-conteudo.png'), tela: '' },
  { key: 'Papo Privado', img: require('../assets/tab-papo.png'), tela: '' },
  { key: 'Mensagens', img: require('../assets/tab-mensagens.png'), tela: 'Forum' },
  { key: 'Perfil', img: require('../assets/tab-perfil.png'), tela: '' },
];

function SemanaRow() {
  return (
    <View style={styles.semana}>
      {DIAS.map((dia, i) => (
        <View key={i} style={styles.dia}>
          <Text style={styles.diaLabel}>{dia.label}</Text>
          <View
            style={[
              styles.diaCirculo,
              dia.tipo === 'hoje' && styles.diaCheio,
              dia.tipo === 'futuro' && styles.diaTracejado,
            ]}
          >
            <Text style={[styles.diaNumero, dia.tipo === 'hoje' && styles.diaNumeroCheio]}>
              {dia.numero}
            </Text>
          </View>
        </View>
      ))}
    </View>
  );
}

function CardMenstruacao() {
  return (
    <View style={styles.cardMenstruacao}>
      <Image style={styles.brilho} source={require('../assets/brilho-menstruacao.png')} />
      <Text style={styles.menstruacaoTexto}>Menstruação</Text>
      <Text style={styles.menstruacaoDias}>em 2 dias</Text>
      <TouchableOpacity style={styles.botaoInicio}>
        <Text style={styles.botaoInicioTexto}>Início da Menstruação</Text>
      </TouchableOpacity>
    </View>
  );
}

function DicasRow() {
  return (
    <View style={styles.dicasRow}>
      {DICAS.map((dica, i) => (
        <View key={i} style={styles.dicaCard}>
          <View style={styles.dicaConteudo}>
            <Text style={styles.dicaTitulo}>{dica.titulo}</Text>
            {dica.img ? <Image style={styles.dicaImg} source={dica.img} /> : null}
            {dica.botao === '' ? (
              <TouchableOpacity style={styles.dicaMais}>
                <Ionicons name="add" size={20} color="#FFFFFF" />
              </TouchableOpacity>
            ) : null}
          </View>

          {dica.botao !== '' ? (
            <TouchableOpacity style={styles.dicaBotao}>
              <Text style={styles.dicaBotaoTexto}>{dica.botao}</Text>
            </TouchableOpacity>
          ) : null}
        </View>
      ))}
    </View>
  );
}

function BolinhasCiclo() {
  const bolinhas = [];
  for (let i = 0; i < 28; i++) {
    let cor = '#BBBBBB';
    if (i < 5) {
      cor = '#F2AFBC';
    }
    if (i > 21) {
      cor = '#4DE1FF';
    }
    bolinhas.push(<View key={i} style={[styles.bolinha, { backgroundColor: cor }]} />);
  }
  return <View style={styles.bolinhasRow}>{bolinhas}</View>;
}

function CardDiario() {
  return (
    <View style={styles.cardBranco}>
      <Text style={styles.cardTitulo}>
        Diário de <Text style={styles.cardTituloRosa}>• Hoje</Text>
      </Text>

      <View style={styles.itensRow}>
        {SINTOMAS.map((item, i) => (
          <View key={i} style={styles.item}>
            <View style={styles.itemCirculo}>
              <Image style={styles.itemImg} source={item.img} />
              <View style={styles.itemCheck}>
                <Ionicons name="checkmark" size={11} color="#FFFFFF" />
              </View>
            </View>
            <Text style={styles.itemNome}>{item.nome}</Text>
          </View>
        ))}
      </View>

      <View style={styles.divisoria} />

      <View style={styles.itensRow}>
        {REGISTROS.map((item, i) => (
          <View key={i} style={styles.item}>
            <Image style={styles.itemImgSolta} source={item.img} />
            <Text style={styles.itemNome}>{item.nome}</Text>
          </View>
        ))}
      </View>

      <Text style={styles.conhecaCiclo}>CONHEÇA SEU CICLO</Text>

      {CICLOS.map((periodo, i) => (
        <View key={i} style={styles.periodo}>
          <Text style={styles.periodoTexto}>{periodo}</Text>
          <BolinhasCiclo />
        </View>
      ))}
    </View>
  );
}

function CardSaude() {
  return (
    <View style={styles.cardBranco}>
      <View style={styles.saudeTopo}>
        <Ionicons name="add-circle" size={20} color="#AA1B31" />
        <Text style={styles.saudeTitulo}>Saúde</Text>
      </View>

      {SAUDE.map((item, i) => (
        <View key={i} style={styles.saudeLinha}>
          <View style={styles.saudeIconeBox}>
            <Ionicons name={item.icone} size={18} color="#F2AFBC" />
          </View>
          <View style={styles.saudeTextos}>
            <Text style={styles.saudeNome}>{item.titulo}</Text>
            <Text style={styles.saudeDetalhe}>{item.linha1}</Text>
            <Text style={styles.saudeDetalhe}>{item.linha2}</Text>
          </View>
          <Ionicons name={item.sino} size={20} color="#F2AFBC" />
        </View>
      ))}
    </View>
  );
}

function BottomNav({ navegar }) {
  return (
    <View style={styles.bottomNav}>
      {NAV_ITEMS.map((item, i) => (
        <TouchableOpacity
          key={i}
          style={styles.navItem}
          onPress={() => item.tela !== '' && navegar(item.tela)}
        >
          <Image style={styles.navIcone} source={item.img} />
          <Text style={styles.navLabel}>{item.key}</Text>
        </TouchableOpacity>
      ))}
    </View>
  );
}

export default function DiarioScreen({ navegar }) {
  return (
    <SafeAreaView style={styles.safe}>
      <StatusBar barStyle="dark-content" backgroundColor="#FDF2F5" />

      <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={styles.scrollContent}>
        <SemanaRow />
        <CardMenstruacao />

        <Text style={styles.secaoTitulo}>Dicas de Hoje para você</Text>
        <DicasRow />

        <CardDiario />
        <CardSaude />
      </ScrollView>

      <BottomNav navegar={navegar} />
    </SafeAreaView>
  );
}
