import React, { useState } from 'react';
import { View, Text, TextInput, ScrollView, TouchableOpacity, Image, ImageBackground, SafeAreaView, StatusBar } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import styles from './style';

const PRINCIPAL = {
  autor: 'Anônima',
  tempo: '5h',
  texto: 'Amigas, o que eu posso responder?',
  comentarios: 11,
  curtidas: 14,
  enviados: 10,
};

const RESPOSTAS = [
  { id: 1, autor: 'Anônima', tempo: '5h', texto: 'Amigas, o que eu posso responder?' },
  { id: 2, autor: 'Anônima', tempo: '5h', texto: 'Amigas, o que eu posso responder?' },
  { id: 3, autor: 'Anônima', tempo: '5h', texto: 'Amigas, o que eu posso responder?' },
  { id: 4, autor: 'Anônima', tempo: '5h', texto: 'Amigas, o que eu posso responder?' },
];

const NAV_ITEMS = [
  { key: 'Home', icon: 'home-outline', tela: 'Diario' },
  { key: 'Aprender', icon: 'grid-outline', tela: '' },
  { key: 'Mapa SUS', icon: 'location-outline', tela: '' },
  { key: 'Mensagens', icon: 'chatbubble-ellipses-outline', tela: 'Forum' },
  { key: 'Perfil', icon: 'person-outline', tela: '' },
];

function Contadores({ comentarios, curtidas, enviados, salvo }) {
  return (
    <View style={styles.rodape}>
      <View style={styles.contador}>
        <Ionicons name="chatbubble-outline" size={15} color="#F2AFBC" />
        <Text style={styles.numero}>{comentarios}</Text>
      </View>
      <View style={styles.contador}>
        <Ionicons name="heart-outline" size={15} color="#F2AFBC" />
        <Text style={styles.numero}>{curtidas}</Text>
      </View>
      <View style={styles.contador}>
        <Ionicons name="paper-plane-outline" size={15} color="#F2AFBC" />
        <Text style={styles.numero}>{enviados}</Text>
      </View>

      <View style={styles.espaco} />

      <Ionicons name={salvo ? 'bookmark' : 'bookmark-outline'} size={17} color="#F2AFBC" />
    </View>
  );
}

function Resposta({ item }) {
  return (
    <View style={styles.resposta}>
      <View style={styles.cardTopo}>
        <View style={styles.avatar}>
          <Ionicons name="people" size={14} color="#F2AFBC" />
        </View>
        <Text style={styles.autorResposta}>{item.autor}</Text>
        <Text style={styles.tempo}>{item.tempo}</Text>
      </View>

      <Text style={styles.texto}>"{item.texto}"</Text>

      <Contadores comentarios={11} curtidas={14} enviados={10} salvo={false} />
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
          <Ionicons name={item.icon} size={22} color="#F2AFBC" />
          <Text style={styles.navLabel}>{item.key}</Text>
        </TouchableOpacity>
      ))}
    </View>
  );
}

export default function PostScreen({ navegar }) {
  const [resposta, setResposta] = useState('');

  return (
    <SafeAreaView style={styles.safe}>
      <StatusBar barStyle="light-content" backgroundColor="#F5ABB9" />

      <ImageBackground style={styles.header} source={require('../assets/header-gradiente.png')}>
        <TouchableOpacity style={styles.botaoVoltar} onPress={() => navegar('Forum')}>
          <Text style={styles.textoVoltar}>Voltar</Text>
        </TouchableOpacity>

        <Image style={styles.logo} source={require('../assets/logo-venus.png')} />
      </ImageBackground>

      <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={styles.scrollContent}>
        <View style={styles.principal}>
          <View style={styles.cardTopo}>
            <View style={styles.avatar}>
              <Ionicons name="people" size={16} color="#F2AFBC" />
            </View>
            <Text style={styles.autor}>{PRINCIPAL.autor}</Text>
            <Text style={styles.tempo}>{PRINCIPAL.tempo}</Text>
          </View>

          <Text style={styles.texto}>"{PRINCIPAL.texto}"</Text>

          <View style={styles.areaImagem} />

          <Contadores
            comentarios={PRINCIPAL.comentarios}
            curtidas={PRINCIPAL.curtidas}
            enviados={PRINCIPAL.enviados}
            salvo={true}
          />
        </View>

        {RESPOSTAS.map((item) => (
          <Resposta key={item.id} item={item} />
        ))}
      </ScrollView>

      <View style={styles.responderLinha}>
        <View style={styles.responderBox}>
          <TextInput
            style={styles.responderInput}
            placeholder="Responder..."
            placeholderTextColor="#AA1B31"
            value={resposta}
            onChangeText={setResposta}
          />
          <TouchableOpacity>
            <Ionicons name="image-outline" size={17} color="#F2AFBC" />
          </TouchableOpacity>
          <TouchableOpacity>
            <Ionicons name="camera-outline" size={17} color="#F2AFBC" />
          </TouchableOpacity>
        </View>
      </View>

      <BottomNav navegar={navegar} />
    </SafeAreaView>
  );
}
