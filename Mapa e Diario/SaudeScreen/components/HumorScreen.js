
import React from 'react';
import {
  View,
  Text,
  TouchableOpacity,
  Image,
} from 'react-native';
import estilos from '../styles';

const humores = [
  { emoji: '😔', label: 'Triste', valor: 'triste', imagem: require('../../assets/triste.png') },
  { emoji: '😕', label: 'Desanimada', valor: 'desanimada', imagem: require('../../assets/desanimada.png') },
  { emoji: '😐', label: 'Neutro', valor: 'neutro', imagem: require('../../assets/neutro.png') },
  { emoji: '🙂', label: 'Feliz', valor: 'feliz', imagem: require('../../assets/feliz.png') },
  { emoji: '😄', label: 'Muito feliz', valor: 'muito_feliz', imagem: require('../../assets/mfeliz.png') },
];

const historicoBase = [
  { dia: 'Seg', emoji: '😔', imagem: require('../../assets/triste.png') },
  { dia: 'Ter', emoji: '😐', imagem: require('../../assets/neutro.png') },
  { dia: 'Qua', emoji: '😕', imagem: require('../../assets/desanimada.png') },
  { dia: 'Qui', emoji: '😄', imagem: require('../../assets/mfeliz.png') },
  { dia: 'Sex', emoji: '😔', imagem: require('../../assets/triste.png') },
  { dia: 'Sáb', emoji: '🙂', imagem: require('../../assets/feliz.png') },
  { dia: 'Hoje', emoji: '😕', imagem: require('../../assets/desanimada.png') },
];

export default function HumorScreen({ humorSelecionado, setHumorSelecionado }) {
  const selecionarHumor = (humor) => setHumorSelecionado(humor);
  const textoRegistrado = humorSelecionado ? `${humorSelecionado.label}` : '';
  const historico = historicoBase.map((item) => {
    if (item.dia === 'Hoje' && humorSelecionado) {
      return { ...item, imagem: humorSelecionado.imagem };
    }
    return item;
  });

  return (
    <View style={estilos.containerHumor}>
      <Text style={estilos.tituloHumor}>Como você está hoje?</Text>
      <View style={estilos.linhaHumores}>
        {humores.map((humor) => {
          const isSelecionado = humorSelecionado && humorSelecionado.valor === humor.valor;
          return (
            <TouchableOpacity
              key={humor.valor}
              style={[estilos.circuloHumor, isSelecionado && estilos.circuloHumorSelecionado]}
              onPress={() => selecionarHumor(humor)}
            >
              <Image source={humor.imagem} style={estilos.imagemHumor} resizeMode="contain" />
            </TouchableOpacity>
          );
        })}
      </View>
      <View style={estilos.areaHumorRegistrado}>
        <Text style={[estilos.humorRegistradoLabel, { opacity: humorSelecionado ? 1 : 0 }]}>
          Humor registrado:
        </Text>
        {humorSelecionado && (
          <>
            <Text style={estilos.humorRegistradoValor}>{textoRegistrado}</Text>
            <Image source={humorSelecionado.imagem} style={estilos.imagemHumorPequena} resizeMode="contain" />
          </>
        )}
      </View>
      <View style={estilos.cardHistorico}>
        <Text style={estilos.tituloHistorico}>Histórico desta semana</Text>
        <View style={estilos.linhaHistorico}>
          {historico.map((item, index) => (
            <View key={index} style={estilos.diaHistorico}>
              <Text style={[estilos.rotuloDiaHistorico, item.dia === 'Hoje' && estilos.rotuloDiaHistoricoHoje]}>
                {item.dia}
              </Text>
              <Image source={item.imagem} style={estilos.imagemHistorico} resizeMode="contain" />
            </View>
          ))}
        </View>
      </View>
    </View>
  );
}