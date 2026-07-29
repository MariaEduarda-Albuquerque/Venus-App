import React, { useState } from 'react';
import { View, Text, TextInput, FlatList, TouchableOpacity, StyleSheet, SafeAreaView, StatusBar, Image } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { FontAwesome6 } from '@expo/vector-icons/FontAwesome6';
import styles from './style';

const ARTICLES = [1, 2, 3, 4].map((id) => ({
  id,
  tag: 'ISTs',
  thumb: 'https://cdn-icons-png.flaticon.com/512/2659/2659980.png',
  title: 'O que são, como identificar e tratar.',
  readTime: '4 min de leitura',
  viewedOf: '4 de 5 visto',
  percent: 75,
}));
 
const TABS = ['Todos', 'ISTs', 'Gravidez'];
 
const NAV_ITEMS = [
  { key: 'Home', icon: 'home-outline' },
  { key: 'Diário', icon: 'grid-outline' },
  { key: 'Papo Privado', icon: 'glasses-outline' },
  { key: 'Mensagem', icon: 'chatbubble-ellipses-outline' },
  { key: 'Perfil', icon: 'person-outline' },
];
 
function ProgressBar({ percent }) {
  return (
    <View style={styles.progressTrack}>
      <View style={[styles.progressFill, { width: `${percent}%` }]} />
    </View>
  );
}
 
function ArticleCard({ article }) {
  return (
    <View style={styles.card}>
        <Image style={styles.cardThumb} source={{ uri : article.thumb}}/>
      <View style={styles.cardBody}>
        <View style={styles.tagPill}>
          <Text style={styles.tagPillText}>{article.tag}</Text>
        </View>
 
        <Text style={styles.cardTitle}>{article.title}</Text>
        <Text style={styles.cardReadTime}>{article.readTime}</Text>
 
        <View style={styles.cardProgressRow}>
          <Text style={styles.cardViewed}>{article.viewedOf}</Text>
          <Text style={styles.cardPercent}>{article.percent}%</Text>
        </View>
        <ProgressBar percent={article.percent} />
      </View>
    </View>
  );
}
 
function TabsRow({ activeTab, onSelectTab }) {
  return (
    <FlatList
      data={TABS}
      keyExtractor={(tab) => tab}
      horizontal
      showsHorizontalScrollIndicator={false}
      scrollEnabled={false} 
      contentContainerStyle={styles.tabsRow}
      renderItem={({ item: tab }) => {
        const active = tab === activeTab;
        return (
          <TouchableOpacity
            onPress={() => onSelectTab(tab)}
            style={[styles.tabButton, active && styles.tabButtonActive]}
          >
            <Text style={[styles.tabButtonText, active && styles.tabButtonTextActive]}>
              {tab}
            </Text>
          </TouchableOpacity>
        );
      }}
    />
  );
}
 
function BottomNav() {
  return (
    <FlatList
      data={NAV_ITEMS}
      keyExtractor={(item) => item.key}
      horizontal
      scrollEnabled={false} 
      style={styles.bottomNav}
      contentContainerStyle={{ flex: 1, justifyContent: 'space-around' }}
      renderItem={({ item }) => (
        <TouchableOpacity style={styles.navItem}>
          <Ionicons name={item.icon} size={22} color="#F06292" />
          <Text style={styles.navLabel}>{item.key}</Text>
        </TouchableOpacity>
      )}
    />
  );
}
 
function ListHeader({ activeTab, onSelectTab, search, onChangeSearch }) {
  return (
    <>
      <View style={styles.header}>
        <View style={styles.headerTopRow}>
          <Text style={styles.headerTitle}>APRENDER</Text>
          <View style={styles.headerBadge}>
            <Text style={styles.headerBadgeText}>20 artigos</Text>
          </View>
        </View>
 
        <View style={styles.searchBar}>
          <Ionicons name="search" size={18} color="#C2185B" />
          <TextInput
            style={styles.searchInput}
            placeholder="Pesquise um tema..."
            placeholderTextColor="#C2185B99"
            value={search}
            onChangeText={onChangeSearch}
          />
        </View>
      </View>
 
      <View style={styles.progressCard}>
        <Text style={styles.progressPercent}>80%</Text>
        <View style={{ flex: 1, marginLeft: 14 }}>
          <Text style={styles.progressTitle}>Seu progresso</Text>
          <Text style={styles.progressSubtitle}>
            Você leu 16 de 20 artigos disponíveis
          </Text>
        </View>
      </View>
 
      <TabsRow activeTab={activeTab} onSelectTab={onSelectTab} />
 
      <View style={styles.sectionHeaderRow}>
        <Text style={styles.sectionHeaderTitle}>Conteúdos por categoria</Text>
        <TouchableOpacity>
          <Text style={styles.sectionHeaderLink}>Ver todos</Text>
        </TouchableOpacity>
      </View>
    </>
  );
}
 
export default function AprenderScreen() {
  const [activeTab, setActiveTab] = useState('Todos');
  const [search, setSearch] = useState('');
 
  return (
    <SafeAreaView style={styles.safe}>
      <StatusBar barStyle="light-content" backgroundColor="#E91E63" />

      <FlatList
        data={ARTICLES}
        keyExtractor={(article) => String(article.id)}
        renderItem={({ item }) => <ArticleCard article={item} />}
        showsVerticalScrollIndicator={false}
        contentContainerStyle={styles.scrollContent}
        ListHeaderComponent={
          <ListHeader
            activeTab={activeTab}
            onSelectTab={setActiveTab}
            search={search}
            onChangeSearch={setSearch}
          />
        }
      />
 
      <BottomNav />
    </SafeAreaView>
  );
}