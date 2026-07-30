import React, { useState } from 'react';
import {
  SafeAreaView,
  ScrollView,
  View,
  StyleSheet,
  TouchableOpacity,
  Image,
  Text,
} from 'react-native';
import {
  useFonts,
  Nunito_400Regular,
  Nunito_600SemiBold,
  Nunito_700Bold,
  Nunito_900Black,
  Nunito_200ExtraLight,
  Nunito_300Light,
} from '@expo-google-fonts/nunito';
import SaudeScreen from './SaudeScreen/SaudeScreen';
import MapaScreen from './MapaScreen/MapaScreen';
// Import do AprenderScreen removido

const iconeHome = require('./assets/Home.png');
const iconeConteudo = require('./assets/Conteúdo.png'); // mantido para o botão
const iconeMapa = require('./assets/location.png');
const iconeMensagens = require('./assets/Mensagens.png');
const iconePerfil = require('./assets/Perfil.png');

export default function App() {
  const [fontesCarregadas] = useFonts({
    Nunito_400Regular,
    Nunito_600SemiBold,
    Nunito_700Bold,
    Nunito_900Black,
    Nunito_200ExtraLight,
    Nunito_300Light,
  });

  const [telaAtiva, setTelaAtiva] = useState('Home');

  if (!fontesCarregadas) return null;

  const renderTela = () => {
    switch (telaAtiva) {
      case 'Home':
        return <SaudeScreen />;
      // case 'Aprender': removido – não existe mais
      case 'Mapa':
        return <MapaScreen />;
      default:
        return <SaudeScreen />;
    }
  };

  return (
    <SafeAreaView style={estilos.seguro}>
      <ScrollView
        style={estilos.scroll}
        contentContainerStyle={estilos.conteudoScroll}
        showsVerticalScrollIndicator={false}
      >
        {renderTela()}
        <FooterGlobal telaAtiva={telaAtiva} setTelaAtiva={setTelaAtiva} />
      </ScrollView>
    </SafeAreaView>
  );
}

function FooterGlobal({ telaAtiva, setTelaAtiva }) {
  const itens = [
    { label: 'Home', icone: iconeHome, key: 'Home' },
    { 
      label: 'Aprender', 
      icone: iconeConteudo, 
      key: 'Aprender',
      // Ao clicar, redireciona para Home em vez de abrir AprenderScreen
      onPress: () => setTelaAtiva('Home') 
    },
    { label: 'Mapa', icone: iconeMapa, key: 'Mapa' },
    { label: 'Mensagens', icone: iconeMensagens, key: 'Mensagens' },
    { label: 'Perfil', icone: iconePerfil, key: 'Perfil' },
  ];

  return (
    <View style={estilos.containerNavInferior}>
      <View style={estilos.conteudoNavInferior}>
        {itens.map(({ label, icone, key, onPress }) => (
          <TouchableOpacity
            key={key}
            style={estilos.itemNav}
            onPress={onPress || (() => setTelaAtiva(key))} // usa o onPress personalizado se existir
          >
            <Image source={icone} style={estilos.iconeNav} resizeMode="contain" />
            <Text style={estilos.textoNav}>{label}</Text>
          </TouchableOpacity>
        ))}
      </View>
    </View>
  );
}

const estilos = StyleSheet.create({
  seguro: {
    flex: 1,
    backgroundColor: '#FDF4F6',
  },
  scroll: {
    flex: 1,
  },
  conteudoScroll: {
    flexGrow: 1,
  },
  containerNavInferior: {
    width: '100%',
    minHeight: 78,
    borderTopLeftRadius: 16,
    borderTopRightRadius: 16,
    backgroundColor: 'rgba(255,255,255,0.5)',
    overflow: 'hidden',
    marginTop: 20,
  },
  conteudoNavInferior: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    height: 78,
    paddingHorizontal: 16,
  },
  itemNav: {
    alignItems: 'center',
    justifyContent: 'center',
  },
  iconeNav: {
    width: 40,
    height: 40,
  },
  textoNav: {
    fontFamily: 'Nunito_700Bold',
    fontSize: 12,
    color: '#BBBBBB',
    marginTop: 2,
  },
});