import React, { useState } from 'react';
import { View, Text, TextInput, FlatList, TouchableOpacity, Image, SafeAreaView, StatusBar } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import styles from './style';

const POSTS = [
  {
    id: 1,
    autor: 'Anônima',
    tempo: '2h',
    texto: 'Alguém sabe se pode pegar DIU pelo SUS sem ter filho? Perguntando por uma amiga 😅',
    comentarios: 12,
    curtidas: 28,
    enviados: 3,
    curtido: true,
    salvo: false,
    alto: false,
  },
  {
    id: 2,
    autor: 'Anônima',
    tempo: '5h',
    texto: 'Amigas, o que eu posso responder?',
    comentarios: 11,
    curtidas: 14,
    enviados: 10,
    curtido: false,
    salvo: true,
    alto: true,
  },
];

const NAV_ITEMS = [
  { key: 'Home', icon: 'home-outline', tela: 'Diario' },
  { key: 'Aprender', icon: 'grid-outline', tela: '' },
  { key: 'Mapa SUS', icon: 'location-outline', tela: '' },
  { key: 'Mensagens', icon: 'chatbubble-ellipses-outline', tela: 'Forum' },
  { key: 'Perfil', icon: 'person-outline', tela: '' },
];

function PostCard({ post, navegar }) {
  return (
    <TouchableOpacity
      style={[styles.card, post.alto && styles.cardAlto]}
      onPress={() => navegar('Post')}
      activeOpacity={0.9}
    >
      <View style={styles.cardTopo}>
        <View style={styles.avatar}>
          <Ionicons name="people" size={16} color="#F2AFBC" />
        </View>
        <Text style={styles.autor}>{post.autor}</Text>
        <Text style={styles.tempo}>{post.tempo}</Text>
      </View>

      <Text style={styles.texto}>"{post.texto}"</Text>

      <View style={styles.rodape}>
        <View style={styles.contador}>
          <Ionicons name="chatbubble-outline" size={15} color="#F2AFBC" />
          <Text style={styles.numero}>{post.comentarios}</Text>
        </View>
        <View style={styles.contador}>
          <Ionicons name={post.curtido ? 'heart' : 'heart-outline'} size={15} color="#F2AFBC" />
          <Text style={styles.numero}>{post.curtidas}</Text>
        </View>
        <View style={styles.contador}>
          <Ionicons name="paper-plane-outline" size={15} color="#F2AFBC" />
          <Text style={styles.numero}>{post.enviados}</Text>
        </View>

        <View style={styles.espaco} />

        <Ionicons name={post.salvo ? 'bookmark' : 'bookmark-outline'} size={17} color="#F2AFBC" />
      </View>
    </TouchableOpacity>
  );
}

function Header({ busca, onChangeBusca }) {
  return (
    <View style={styles.header}>
      <Text style={styles.logo}>Vênus ·</Text>

      <View style={styles.headerLinha}>
        <TouchableOpacity>
          <Ionicons name="options-outline" size={26} color="#AA1B31" />
        </TouchableOpacity>

        <View style={styles.buscaBox}>
          <Ionicons name="search" size={17} color="#AA1B31" />
          <TextInput
            style={styles.buscaInput}
            placeholder="Pesquisar..."
            placeholderTextColor="#AA1B31"
            value={busca}
            onChangeText={onChangeBusca}
          />
        </View>

        <TouchableOpacity style={styles.avatarTopo}>
          <Ionicons name="person" size={18} color="#FFFFFF" />
        </TouchableOpacity>
      </View>
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

export default function ForumScreen({ navegar }) {
  const [busca, setBusca] = useState('');

  return (
    <SafeAreaView style={styles.safe}>
      <StatusBar barStyle="dark-content" backgroundColor="#F8CBD5" />

      <Header busca={busca} onChangeBusca={setBusca} />

      <FlatList
        data={POSTS}
        keyExtractor={(post) => String(post.id)}
        renderItem={({ item }) => <PostCard post={item} navegar={navegar} />}
        showsVerticalScrollIndicator={false}
        contentContainerStyle={styles.lista}
      />

      <TouchableOpacity style={styles.botaoMais} onPress={() => navegar('Postar')}>
        <Ionicons name="add" size={28} color="#FFFFFF" />
      </TouchableOpacity>

      <BottomNav navegar={navegar} />
    </SafeAreaView>
  );
}
