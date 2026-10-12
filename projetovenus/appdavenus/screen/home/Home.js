import { Text as ScaledText } from '../../context/ScaledText';
import { useState } from 'react';
import { useNavigation } from '@react-navigation/native';
import {
  Image,
  ImageBackground,
  SafeAreaView,
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  useWindowDimensions,
  View
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import {
  useFonts,
  BricolageGrotesque_400Regular,
  BricolageGrotesque_500Medium,
  BricolageGrotesque_600SemiBold,
  BricolageGrotesque_700Bold,
  BricolageGrotesque_800ExtraBold,
} from '@expo-google-fonts/bricolage-grotesque';
import { Nunito_400Regular } from '@expo-google-fonts/nunito';
import { useAuth } from '../../context/AuthContext';
import { usePreferences } from '../../context/PreferencesContext';
import AppTabBar from '../themes/AppTabBar';
 
const COLORS = {
  background: '#FFF5F1',
  headerPink: '#F7A8BF',
  wine: '#A81D37',
  ink: '#4A1020',
  muted: '#8A6670',
  border: '#F1D3DA',
  white: '#FFFFFF',
};
 
// Bricolage Grotesque em toda a tela; Nunito só no texto dos comentários da comunidade
const FONT = {
  regular: 'BricolageGrotesque_400Regular',
  medium: 'BricolageGrotesque_500Medium',
  semibold: 'BricolageGrotesque_600SemiBold',
  bold: 'BricolageGrotesque_700Bold',
  extrabold: 'BricolageGrotesque_800ExtraBold',
  comment: 'Nunito_400Regular',
};
 
const TABS = [
  { key: 'Home', label: 'Home', icon: 'home-outline', flex: 62, route: 'Home' },
  { key: 'Diario', label: 'Diário', icon: 'calendar-outline', flex: 58, route: null },
  { key: 'Mapa', label: 'Mapa', icon: 'location-outline', flex: 69, route: null },
  { key: 'Mensagens', label: 'Mensagens', icon: 'chatbubble-outline', flex: 79, route: null },
  { key: 'Comunidade', label: 'Comunidade', icon: 'people-outline', flex: 76, route: null },
  { key: 'Perfil', label: 'Perfil', icon: 'person-outline', flex: 68, route: 'Perfil' },
];
 
const CYCLE = {
  day: 14,
  phase: 'Fase fértil',
  daysToNext: 12,
};
 
const FOR_YOU_ITEMS = [
  {
    id: '1',
    badge: 'Novo',
    badgeBg: '#E4E6F8',
    badgeColor: '#5A5FB0',
    title: 'Pré-natal pelo SUS: o que você precisa saber',
    meta: '5 min de leitura · Gravidez',
    image: require('../../assets/homeicone1.png'),
  },
  {
    id: '2',
    badge: 'Recomendado',
    badgeBg: '#E1F0E3',
    badgeColor: '#3F7A4A',
    title: 'HPV: sintomas, prevenção e vacina gratuita',
    meta: '4 min de leitura · ISTs e Prevenção',
    image: require('../../assets/homeicone2.png'),
  },
  {
    id: '3',
    badge: 'Em alta',
    badgeBg: '#FCE3DC',
    badgeColor: '#C2563F',
    title: 'Seus direitos reprodutivos no SUS',
    meta: '7 min de leitura · Meus Direitos',
    image: require('../../assets/homeicone3.png'),
  },
];
 
const COMMUNITY_THREADS = [
  {
    id: '1',
    author: 'Anônima',
    time: '2h',
    tag: 'Dúvidas',
    message: 'Alguém sabe se posso pegar DIU pelo SUS sem ter filhos? Perguntando por uma amiga 😅',
    likesCount: 12,
    repliesCount: 2,
    sharesCount: 12,
  },
  {
    id: '2',
    author: 'MarFernandez',
    time: '4h',
    tag: 'Dúvidas',
    message: 'Alguma dica pra melhorar a cólica? O remédio não está fazendo mais efeito pra mim.',
    likesCount: 32,
    repliesCount: 67,
    sharesCount: 5,
  },
];
 
const MESES = {
  'pt-BR': ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho', 'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'],
  es: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
  en: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
};

const HOME_TEXTS = {
  'pt-BR': {
    today: 'Hoje',
    hello: 'Olá',
    welcome: 'Que bom te ver por aqui de novo.',
    cycleDay: 'Dia',
    cycleOf: 'do seu ciclo',
    nextPeriod: 'próxima menstruação em',
    days: 'dias',
    fertilePhase: 'Fase fértil',
    articles: 'Artigos para você',
    seeAll: 'Ver tudo',
    community: 'Comunidade',
    share: 'Compartilhe algo com a comunidade...',
    questions: 'Dúvidas',
    guest: 'visitante',
  },
  es: {
    today: 'Hoy',
    hello: 'Hola',
    welcome: 'Qué bueno verte por aquí otra vez.',
    cycleDay: 'Día',
    cycleOf: 'de tu ciclo',
    nextPeriod: 'próxima menstruación en',
    days: 'días',
    fertilePhase: 'Fase fértil',
    articles: 'Artículos para ti',
    seeAll: 'Ver todo',
    community: 'Comunidad',
    share: 'Comparte algo con la comunidad...',
    questions: 'Dudas',
    guest: 'visitante',
  },
  en: {
    today: 'Today',
    hello: 'Hello',
    welcome: 'Good to see you again.',
    cycleDay: 'Day',
    cycleOf: 'of your cycle',
    nextPeriod: 'next period in',
    days: 'days',
    fertilePhase: 'Fertile phase',
    articles: 'Articles for you',
    seeAll: 'See all',
    community: 'Community',
    share: 'Share something with the community...',
    questions: 'Questions',
    guest: 'guest',
  },
};

function formatarDataDeHoje(idioma = 'pt-BR') {
  const hoje = new Date();
  const meses = MESES[idioma] || MESES['pt-BR'];

  if (idioma === 'en') {
    return `${meses[hoje.getMonth()]} ${hoje.getDate()}`;
  }

  if (idioma === 'es') {
    return `${hoje.getDate()} de ${meses[hoje.getMonth()]}`;
  }

  return `${hoje.getDate()} de ${meses[hoje.getMonth()]}`;
}

export default function Home() {
  const { colors, dark, highContrast, preferences } = usePreferences();
  const navigation = useNavigation();
  const { user, isGuest } = useAuth();
  const { width } = useWindowDimensions();
  const idioma = preferences.idiomaUsuario || 'pt-BR';
  const strings = HOME_TEXTS[idioma] || HOME_TEXTS['pt-BR'];
  const [fontsLoaded] = useFonts({
    BricolageGrotesque_400Regular,
    BricolageGrotesque_500Medium,
    BricolageGrotesque_600SemiBold,
    BricolageGrotesque_700Bold,
    BricolageGrotesque_800ExtraBold,
    Nunito_400Regular,
  });
  // Preserva a sobreposição do card, mas expande o cabeçalho quando o texto quebra.
  const cardOverlap = (width * 114) / 412;
  const baseHeaderHeight = (width * 307) / 412;
  const [headerContentHeight, setHeaderContentHeight] = useState(0);
  const headerHeight = Math.max(baseHeaderHeight, headerContentHeight + cardOverlap + 20);
  const greetingName = user?.nomeUsuario || user?.nome || (isGuest ? strings.guest : strings.guest);
  const dataHoje = formatarDataDeHoje(idioma);
 
  function handleTabPress(tab) {
    if (tab.route === 'Home') {
      navigation.navigate('Home');
    } else if (tab.route === 'Perfil') {
      navigation.navigate('Perfil', { id: user?.codUsuario ?? user?.id });
    }
  }
 
  if (!fontsLoaded) return null;
 
  return (
    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>
      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
      >
        <ImageBackground
          source={require('../../assets/homeheader.png')}
          style={[styles.header, { height: headerHeight }]}
          resizeMode="stretch"
        >
          <View
            style={styles.headerContent}
            onLayout={(event) => {
              const measuredHeight = event.nativeEvent.layout.height;
              setHeaderContentHeight((currentHeight) =>
                Math.abs(currentHeight - measuredHeight) > 0.5 ? measuredHeight : currentHeight
              );
            }}
          >
            <View style={styles.headerTopRow}>
              <ScaledText style={styles.headerDate}>{strings.today} · {dataHoje}</ScaledText>
              <TouchableOpacity
                style={styles.settingsButton}
                onPress={() => navigation.navigate('Configuracoes')}
                accessibilityRole="button"
                accessibilityLabel="Configurações"
              >
                <Ionicons name="settings-outline" size={20} color={COLORS.white} />
              </TouchableOpacity>
            </View>

            <ScaledText style={styles.headerGreeting}>{strings.hello}, {greetingName}!</ScaledText>
            <ScaledText style={styles.headerSubtitle}>{strings.welcome}</ScaledText>
          </View>
        </ImageBackground>
 
        <View style={[styles.content, { marginTop: -cardOverlap }]}>
          {/* CARD DO CICLO */}
<View style={[styles.cycleCard, { backgroundColor: colors.card, borderColor: colors.border }]}>
            <View style={styles.cycleRingWrapper}>
              <View style={[styles.cycleRing, { borderColor: colors.wine, borderLeftColor: dark ? '#513745' : '#F3D3DA' }]} />
              <ScaledText style={[styles.cycleDay, { color: colors.text }]}>{CYCLE.day}</ScaledText>
            </View>
 
            <View style={styles.cycleTexts}>
              <ScaledText style={[styles.cycleTitle, { color: colors.text }]}>{strings.cycleDay} {CYCLE.day} {strings.cycleOf}</ScaledText>
              <ScaledText style={[styles.cycleSubtitle, { color: colors.muted }]}>
                {strings.fertilePhase} · {strings.nextPeriod} {CYCLE.daysToNext} {strings.days}
              </ScaledText>
            </View>
          </View>
 
          {/* ARTIGOS */}
          <View style={styles.sectionHeaderRow}>
            <ScaledText style={[styles.sectionTitle, { color: colors.text }]}>{strings.articles}</ScaledText>
            <TouchableOpacity>
              <ScaledText style={[styles.linkText, { color: colors.wine }]}>{strings.seeAll}</ScaledText>
            </TouchableOpacity>
          </View>
 
          <View style={[styles.forYouCard, { backgroundColor: colors.card, borderColor: colors.border }]}>
            {FOR_YOU_ITEMS.map((item, index) => (
              <View
                key={item.id}
                style={[styles.forYouRow, index > 0 && styles.forYouRowDivider]}
              >
                <Image source={item.image} style={styles.forYouThumb} resizeMode="contain" />
 
                <View style={styles.forYouTexts}>
                  <View style={[styles.badge, { backgroundColor: item.badgeBg }]}>
                    <ScaledText style={[styles.badgeText, { color: item.badgeColor }]}>{item.badge}</ScaledText>
                  </View>
                  <ScaledText style={[styles.forYouTitle, { color: colors.text }]}>{item.title}</ScaledText>
                  <ScaledText style={[styles.forYouMeta, { color: colors.muted }]}>{item.meta}</ScaledText>
                </View>
              </View>
            ))}
          </View>
 
          {/* COMUNIDADE */}
          <View style={[styles.sectionHeaderRow, styles.communityHeader]}>
            <ScaledText style={[styles.sectionTitle, { color: colors.text }]}>{strings.community}</ScaledText>
            <TouchableOpacity>
              <ScaledText style={[styles.linkText, { color: colors.wine }]}>{strings.seeAll}</ScaledText>
            </TouchableOpacity>
          </View>
 
          <TouchableOpacity style={[styles.composerCard, { backgroundColor: colors.card, borderColor: colors.border }]} activeOpacity={0.8}>
            <View style={[styles.avatar, { backgroundColor: dark ? colors.iconBg : '#C9A4AC' }]}>
              <Ionicons name="person" size={18} color={dark ? colors.wine : COLORS.white} />
            </View>
            <ScaledText style={[styles.composerText, { color: colors.muted }]}>{strings.share}</ScaledText>
            <Ionicons name="add" size={20} color={colors.wine} />
          </TouchableOpacity>
 
          {COMMUNITY_THREADS.map((thread) => (
            <View key={thread.id} style={[styles.threadCard, { backgroundColor: colors.card, borderColor: colors.border }]}>
              <View style={styles.threadHeaderRow}>
                <View style={[styles.avatar, { backgroundColor: dark ? colors.iconBg : '#C9A4AC' }]}>
                  <Ionicons name="person" size={18} color={dark ? colors.wine : COLORS.white} />
                </View>
                <View style={styles.threadAuthorBlock}>
                  <ScaledText style={[styles.threadAuthor, { color: colors.text }]}>{thread.author}</ScaledText>
                  <ScaledText style={[styles.threadTime, { color: colors.muted }]}>
                    {thread.time} · {strings.questions}
                  </ScaledText>
                </View>
                <TouchableOpacity hitSlop={{ top: 8, bottom: 8, left: 8, right: 8 }}>
                  <Ionicons name="ellipsis-horizontal" size={18} color={colors.text} />
                </TouchableOpacity>
              </View>

              <ScaledText style={[styles.threadMessage, { color: colors.text }]}>{thread.message}</ScaledText>

              <View style={styles.threadActionsRow}>
                <View style={styles.threadAction}>
                  <Ionicons name="heart-outline" size={16} color={colors.muted} />
                  <ScaledText style={[styles.threadActionText, { color: colors.muted }]}>{thread.likesCount}</ScaledText>
                </View>
                <View style={styles.threadAction}>
                  <Ionicons name="chatbubble-outline" size={16} color={colors.muted} />
                  <ScaledText style={[styles.threadActionText, { color: colors.muted }]}>{thread.repliesCount}</ScaledText>
                </View>
                <View style={styles.threadAction}>
                  <Ionicons name="repeat-outline" size={18} color={colors.muted} />
                  <ScaledText style={[styles.threadActionText, { color: colors.muted }]}>{thread.sharesCount}</ScaledText>
                </View>
              </View>
            </View>
          ))}
        </View>
      </ScrollView>
 
      <AppTabBar
        image={require('../../assets/homefooter.png')}
        tabs={TABS}
        activeKey="Home"
        onTabPress={handleTabPress}
      />
    </SafeAreaView>
  );
}
 
const cardShadow = {
  shadowColor: '#A81D37',
  shadowOpacity: 0.12,
  shadowRadius: 12,
  shadowOffset: { width: 0, height: 4 },
  elevation: 3,
};
 
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: COLORS.background,
  },
  scroll: {
    flex: 1,
  },
  scrollContent: {
    paddingBottom: 32,
  },
 
  /* Header */
  header: {
    width: '100%',
  },
  headerContent: {
    paddingHorizontal: 24,
    paddingTop: 44,
  },
  headerTopRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  headerDate: {
    color: COLORS.white,
    fontSize: 12,
    fontFamily: FONT.bold,
  },
  settingsButton: {
    width: 38,
    height: 38,
    borderRadius: 19,
    backgroundColor: 'rgba(255,255,255,0.3)',
    alignItems: 'center',
    justifyContent: 'center',
  },
  headerGreeting: {
    fontSize: 30,
    fontFamily: FONT.extrabold,
    color: COLORS.white,
    marginTop: 12,
  },
  headerSubtitle: {
    fontFamily: FONT.regular,
    fontSize: 13,
    color: 'rgba(255,255,255,0.85)',
    marginTop: 8,
  },
 
  content: {
    paddingHorizontal: 16,
  },
 
  /* Card do ciclo */
  cycleCard: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: COLORS.white,
    borderRadius: 18,
    borderWidth: 1,
    padding: 16,
    marginBottom: 28,
    ...cardShadow,
  },
  cycleRingWrapper: {
    width: 48,
    height: 48,
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 14,
  },
  cycleRing: {
    ...StyleSheet.absoluteFillObject,
    borderRadius: 24,
    borderWidth: 4,
    borderColor: COLORS.wine,
    borderLeftColor: '#F3D3DA',
    transform: [{ rotate: '-20deg' }],
  },
  cycleDay: {
    fontSize: 18,
    fontFamily: FONT.extrabold,
    color: COLORS.ink,
  },
  cycleTexts: {
    flex: 1,
    minWidth: 0,
    flexShrink: 1,
  },
  cycleTitle: {
    fontSize: 14,
    fontFamily: FONT.bold,
    color: COLORS.ink,
    marginBottom: 4,
    flexShrink: 1,
  },
  cycleSubtitle: {
    fontFamily: FONT.regular,
    fontSize: 12,
    lineHeight: 17,
    color: COLORS.muted,
    flexShrink: 1,
  },
 
  /* Seções */
  sectionHeaderRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 12,
  },
  communityHeader: {
    marginTop: 28,
  },
  sectionTitle: {
    fontSize: 21,
    fontFamily: FONT.extrabold,
    color: COLORS.ink,
  },
  linkText: {
    fontSize: 12,
    fontFamily: FONT.bold,
  },
 
  /* Artigos */
  forYouCard: {
    backgroundColor: COLORS.white,
    borderRadius: 22,
    borderWidth: 1,
    borderColor: COLORS.border,
    overflow: 'hidden',
    ...cardShadow,
  },
  forYouRow: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingVertical: 14,
    paddingHorizontal: 14,
  },
  forYouRowDivider: {
    borderTopWidth: 1,
    borderTopColor: COLORS.border,
  },
  forYouThumb: {
    width: 50,
    height: 50,
    marginRight: 12,
  },
  forYouTexts: {
    flex: 1,
  },
  badge: {
    alignSelf: 'flex-start',
    paddingHorizontal: 10,
    paddingVertical: 3,
    borderRadius: 20,
    marginBottom: 6,
  },
  badgeText: {
    fontSize: 11,
    fontFamily: FONT.semibold,
  },
  forYouTitle: {
    fontSize: 14,
    fontFamily: FONT.extrabold,
    marginBottom: 4,
  },
  forYouMeta: {
    fontFamily: FONT.regular,
    fontSize: 11,
  },
 
  /* Comunidade */
  avatar: {
    width: 36,
    height: 36,
    borderRadius: 18,
    backgroundColor: '#C9A4AC',
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 12,
  },
  composerCard: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: COLORS.white,
    borderRadius: 16,
    paddingVertical: 12,
    paddingHorizontal: 14,
    marginBottom: 14,
    ...cardShadow,
  },
  composerText: {
    fontFamily: FONT.regular,
    flex: 1,
    fontSize: 13,
    color: COLORS.muted,
  },
  threadCard: {
    backgroundColor: COLORS.white,
    borderRadius: 18,
    borderWidth: 1,
    borderColor: COLORS.border,
    padding: 14,
    marginBottom: 14,
  },
  threadHeaderRow: {
    flexDirection: 'row',
    alignItems: 'center',
    marginBottom: 12,
  },
  threadAuthorBlock: {
    flex: 1,
  },
  threadAuthor: {
    fontFamily: FONT.extrabold,
    fontSize: 14,
    color: COLORS.ink,
  },
  threadTime: {
    fontFamily: FONT.regular,
    fontSize: 11,
    color: COLORS.muted,
    marginTop: 2,
  },
  threadMessage: {
    fontFamily: FONT.comment,
    fontSize: 13,
    color: COLORS.ink,
    lineHeight: 19,
    marginBottom: 14,
  },
  threadActionsRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    paddingHorizontal: 10,
  },
  threadAction: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  threadActionText: {
    fontFamily: FONT.regular,
    fontSize: 12,
    color: COLORS.muted,
    marginLeft: 8,
  },
 
});
