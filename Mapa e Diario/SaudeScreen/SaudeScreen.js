import React, { useState, useCallback } from 'react';
import {
  View,
  Text,
  TouchableOpacity,
  Image,
  Alert,
  ScrollView, // <-- adicionado
} from 'react-native';
import { LinearGradient } from 'expo-linear-gradient';
import estilos, { CORES } from './styles';
import CicloScreen from './components/CicloScreen';
import HumorScreen from './components/HumorScreen';
import SaudeTab from './components/SaudeTab';
import NotasScreen from './components/NotasScreen';

export default function SaudeScreen() {
  const [abaAtiva, setAbaAtiva] = useState('Ciclo');
  const [sintomasSelecionados, setSintomasSelecionados] = useState([]);
  const [humorSelecionado, setHumorSelecionado] = useState(null);

  const alternarSintoma = useCallback((sintoma) => {
    setSintomasSelecionados((atual) =>
      atual.includes(sintoma)
        ? atual.filter((item) => item !== sintoma)
        : [...atual, sintoma]
    );
  }, []);

  const marcarInicioMenstruacao = () => {
    Alert.alert('Início da menstruação', 'Data registrada com sucesso!');
  };

  return (
    <ScrollView
      style={estilos.scrollView}
      showsVerticalScrollIndicator={false}
      contentContainerStyle={estilos.scrollContent}
      keyboardShouldPersistTaps="handled"
    >
      <Cabecalho />
      <View style={estilos.abas}>
        {['Ciclo', 'Humor', 'Saúde', 'Notas'].map((aba) => (
          <TouchableOpacity
            key={aba}
            style={estilos.botaoAba}
            onPress={() => setAbaAtiva(aba)}
          >
            <View style={estilos.abaInterna}>
              <Text
                style={[
                  estilos.textoAba,
                  abaAtiva === aba && estilos.textoAbaAtivo,
                ]}
              >
                {aba}
              </Text>
              {abaAtiva === aba && <View style={estilos.sublinhadoAba} />}
            </View>
          </TouchableOpacity>
        ))}
      </View>

      <View style={estilos.conteudo}>
        {abaAtiva === 'Ciclo' && (
          <CicloScreen
            onMarcarInicio={marcarInicioMenstruacao}
            sintomasSelecionados={sintomasSelecionados}
            alternarSintoma={alternarSintoma}
          />
        )}
        {abaAtiva === 'Humor' && (
          <HumorScreen
            humorSelecionado={humorSelecionado}
            setHumorSelecionado={setHumorSelecionado}
          />
        )}
        {abaAtiva === 'Saúde' && <SaudeTab />}
        {abaAtiva === 'Notas' && <NotasScreen />}
      </View>
           </ScrollView>

  );
}


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
      <Text style={estilos.tituloCabecalho}>Meu Diário de Saúde</Text>
    </LinearGradient>
  );
}