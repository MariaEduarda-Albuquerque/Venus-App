// MapaScreen/MapaScreen.js
import React from 'react';
import {
  SafeAreaView,
  ScrollView,
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Image,
  Dimensions,
} from 'react-native';
import { LinearGradient } from 'expo-linear-gradient';
import estilos, { CORES } from './styles';

const { width } = Dimensions.get('window');

// Ícones (substitua pelos caminhos reais dos seus assets)
const iconeBusca = require('../assets/icon.png'); // ou use um ícone de texto

const iconeConteudo = require('../assets/icon.png');


// Componente principal
export default function MapaScreen() {
  return (
    <SafeAreaView style={estilos.container}>
      <ScrollView contentContainerStyle={estilos.scrollContent}>
        <Cabecalho />
        <CampoBusca />
        <Filtros />
        <Mapa />
        <Legenda />
        <CardUnidade />

      </ScrollView>
    </SafeAreaView>
  );
}

// ----- Subcomponentes -----

function Cabecalho() {
  return (
    <LinearGradient
      colors={['#f2afbc', '#fca2b4', '#f8728c']}
      start={{ x: 0, y: 0 }}
      end={{ x: 0, y: 1 }}
      style={estilos.cabecalho}
    >
      <Image source={require('../assets/ondas.png')} style={estilos.imagemOndas} resizeMode="cover" />
      <Image source={require('../assets/ellipse43.png')} style={estilos.imagemElipse} resizeMode="contain" />
      <Text style={estilos.tituloCabecalho}>Mapa SUS</Text>
    </LinearGradient>
  );
}

function CampoBusca() {
  return (
    <View style={estilos.buscaContainer}>
      
      <TextInput
        style={estilos.inputBusca}
        placeholder="Buscar por CEP ou endereço..."
        placeholderTextColor="black"
        returnKeyType="search"
      />
    </View>
  );
}

function Filtros() {
  const [filtroAtivo, setFiltroAtivo] = React.useState('Todos');

  const filtros = ['Todos', 'UBS', 'UPA', 'CAPS'];

  return (
    <View style={estilos.filtrosContainer}>
      {filtros.map((nome) => {
        const ativo = filtroAtivo === nome;
        return (
          <TouchableOpacity
            key={nome}
            style={[
              estilos.botaoFiltro,
              ativo && { backgroundColor: '#AA1B31', borderColor: '#AA1B31' },
            ]}
            onPress={() => setFiltroAtivo(nome)}
          >
            <Text
              style={[
                estilos.textoFiltro,
                ativo && { color: '#FFFFFF' },
              ]}
            >
              {nome}
            </Text>
          </TouchableOpacity>
        );
      })}
    </View>
  );
}

function Mapa() {
  // Simulação de mapa com marcadores
  const marcadores = [
    { x: 84, y: 43, cor: 'verde' },
    { x: 195, y: 149, cor: 'amarelo' },
    { x: 139, y: 244, cor: 'vermelho' },
    { x: 63, y: 302, cor: 'verde' },
    { x: 258, y: 221, cor: 'bordo' },
    { x: 279, y: 302, cor: 'verde' },
  ];

  return (
    <View style={estilos.mapaContainer}>
      {/* Mapa placeholder – você pode substituir por um Image com mapa real */}
      <Image
        source={require('../assets/fakemap.png')} // certifique-se de ter essa imagem
        style={{ width: '100%', height: '100%', position: 'absolute' }}
        resizeMode="cover"
      />
  
    </View>
  );
}

function Legenda() {
  const itens = [
    { cor: '#52A44B', label: 'UBS' },
    { cor: '#9E182B', label: 'UPA' },
    { cor: '#FAAC3F', label: 'CAPS' },
  ];

  return (
    <View style={estilos.legendaContainer}>
      {itens.map((item, idx) => (
        <View key={idx} style={estilos.itemLegenda}>
          <View style={[estilos.bolinhaLegenda, { backgroundColor: item.cor }]} />
          <Text style={[estilos.textoLegendaMapa, { color: item.cor }]}>{item.label}</Text>
        </View>
      ))}
    </View>
  );
}

function CardUnidade() {
  return (
    <View style={estilos.cardUnidade}>
      {/* Header */}
      <View style={estilos.cardHeader}>
        <Text style={estilos.nomeUnidade}>UBS Jardim Robru</Text>
        <Text style={estilos.distanciaUnidade}>0,5 km - UBS</Text>
      </View>

      {/* Corpo */}
      <View style={estilos.cardBody}>
        <Text style={estilos.horarioUnidade}>Seg–Sex 7h–17h | Sáb 7h–12h</Text>
        <Text style={estilos.telefoneUnidade}>(11) 2345-6789</Text>

        {/* Lotação */}
        <View style={estilos.lotacaoContainer}>
          <Text style={estilos.lotacaoTitulo}>Lotação atual</Text>
          <View style={estilos.barraLotacao}>
            <View style={[estilos.barraSegmento, estilos.barraCheia]} />
            <View style={[estilos.barraSegmento, estilos.barraCheia]} />
            <View style={[estilos.barraSegmento, estilos.barraVazia]} />
            <View style={[estilos.barraSegmento, estilos.barraVazia]} />
            <View style={[estilos.barraSegmento, estilos.barraVazia]} />
            <View style={[estilos.barraSegmento, estilos.barraVazia]} />
          </View>
          <Text style={estilos.statusLotacao}>Livre — pouco movimento</Text>
        </View>

        {/* Serviços (chips) */}
        <View style={estilos.servicosContainer}>
          <View style={estilos.chipServico}>
            <Text style={estilos.textoChipServico}>Vacinas</Text>
          </View>
          <View style={estilos.chipServico}>
            <Text style={estilos.textoChipServico}>Ginecologia</Text>
          </View>
          <View style={estilos.chipServico}>
            <Text style={estilos.textoChipServico}>Anticoncepção</Text>
          </View>
          <View style={estilos.chipServico}>
            <Text style={estilos.textoChipServico}>Teste IST</Text>
          </View>
          <View style={estilos.chipServico}>
            <Text style={[estilos.textoChipServico, { color: "black" }]}>Pré-natal</Text>
          </View>
        </View>
      </View>

      {/* Botões */}
      <View style={estilos.botoesContainer}>
        <TouchableOpacity style={estilos.botaoRota}>
          <Text style={estilos.textoBotaoRota}>Traçar rota</Text>
        </TouchableOpacity>
        <TouchableOpacity style={estilos.botaoLigar}>
          <Text style={estilos.textoBotaoLigar}>Ligar</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}

