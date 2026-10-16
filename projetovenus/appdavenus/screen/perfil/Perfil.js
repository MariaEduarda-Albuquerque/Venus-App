import { Text as ScaledText } from '../../context/ScaledText';
import React, { useEffect, useState } from "react";

import {
  View,
  Text,
  TouchableOpacity,
  Alert,
  ScrollView,
  StyleSheet,
  Image,
  ImageBackground,
  SafeAreaView,
  Platform,
  StatusBar,
  useWindowDimensions,
} from "react-native";

import api from "../../api/api";
import { useAuth } from "../../context/AuthContext";
import { usePreferences } from "../../context/PreferencesContext";
import { Ionicons } from "@expo/vector-icons";
import {
  useFonts,
  BricolageGrotesque_700Bold,
  BricolageGrotesque_800ExtraBold,
} from "@expo-google-fonts/bricolage-grotesque";
import {
  Nunito_400Regular,
  Nunito_500Medium,
  Nunito_600SemiBold,
  Nunito_700Bold,
} from "@expo-google-fonts/nunito";
import { commonStyles } from "../themes/theme";
import { urlFoto } from "../utils/fotoPerfil";
import AppTabBar from "../themes/AppTabBar";


const BIO = "Aqui pra aprender e apoiar outras mulheres.";

const PROFILE_TEXTS = {
  'pt-BR': {
    loading: 'Carregando perfil...',
    notFound: 'Usuário não encontrado.',
    errorLoad: 'Não foi possível carregar o perfil.',
    errorTitle: 'Erro',
    edit: 'Editar perfil',
    saved: 'Meus salvos',
    seeAll: 'Ver tudo',
    publications: 'Minhas publicações',
    preferences: 'Preferências',
    bio: 'Aqui pra aprender e apoiar outras mulheres.',
    stats: [
      { key: 'salvos', label: 'Salvos' },
      { key: 'publicacoes', label: 'Publicações' },
      { key: 'consultas', label: 'Consultas' },
    ],
    prefLabels: {
      diario: 'Meu Diário de Saúde',
      filtros: 'Filtros de interesse',
      notificacoes: 'Notificações',
      configuracoes: 'Configurações',
    },
    prefSubtitles: {
      filtros: 'Personalize seu feed',
    },
    tag: {
      duvidas: 'Dúvidas',
      desabafo: 'Desabafo',
    },
  },
  es: {
    loading: 'Cargando perfil...',
    notFound: 'Usuario no encontrado.',
    errorLoad: 'No se pudo cargar el perfil.',
    errorTitle: 'Error',
    edit: 'Editar perfil',
    saved: 'Guardados',
    seeAll: 'Ver todo',
    publications: 'Mis publicaciones',
    preferences: 'Preferencias',
    bio: 'Aquí para aprender y apoyar a otras mujeres.',
    stats: [
      { key: 'salvos', label: 'Guardados' },
      { key: 'publicacoes', label: 'Publicaciones' },
      { key: 'consultas', label: 'Consultas' },
    ],
    prefLabels: {
      diario: 'Mi Diario de Salud',
      filtros: 'Filtros de interés',
      notificacoes: 'Notificaciones',
      configuracoes: 'Configuración',
    },
    prefSubtitles: {
      filtros: 'Personaliza tu feed',
    },
    tag: {
      duvidas: 'Dudas',
      desabafo: 'Desahogo',
    },
  },
  en: {
    loading: 'Loading profile...',
    notFound: 'User not found.',
    errorLoad: 'Could not load profile.',
    errorTitle: 'Error',
    edit: 'Edit profile',
    saved: 'Saved',
    seeAll: 'See all',
    publications: 'My posts',
    preferences: 'Preferences',
    bio: 'Here to learn and support other women.',
    stats: [
      { key: 'salvos', label: 'Saved' },
      { key: 'publicacoes', label: 'Posts' },
      { key: 'consultas', label: 'Consults' },
    ],
    prefLabels: {
      diario: 'My Health Journal',
      filtros: 'Interest filters',
      notificacoes: 'Notifications',
      configuracoes: 'Settings',
    },
    prefSubtitles: {
      filtros: 'Customize your feed',
    },
    tag: {
      duvidas: 'Questions',
      desabafo: 'Vent',
    },
  },
};

const FONT = {
  titleBold: "BricolageGrotesque_700Bold",
  titleExtra: "BricolageGrotesque_800ExtraBold",
  regular: "Nunito_400Regular",
  medium: "Nunito_500Medium",
  semibold: "Nunito_600SemiBold",
  bold: "Nunito_700Bold",
};

const COLORS = {
  background: "#FFF8F4",
  wine: "#AA1B31",
  ink: "#3A1620",
  muted: "#9A7984",
  mutedDark: "#7A5560",
  border: "#F0DCE0",
  white: "#FFFFFF",
  iconBox: "#FCE9EE",
};

const ESTATISTICAS = [
  { key: "salvos", valor: "8" },
  { key: "publicacoes", valor: "3" },
  { key: "consultas", valor: "2" },
];

// offset = posição do ícone dentro do card (ajustada ao design)
const SALVOS = [
  {
    id: "1",
    title: "Pré-natal pelo SUS: o que você precisa saber",
    color: "#F5BDCD",
    image: require("../../assets/perfilsalvo1.png"),
    offset: [-1, 2],
  },
  {
    id: "2",
    title: "HPV: sintomas, prevenção e vacina gratuita",
    color: "#AA1B31",
    image: require("../../assets/perfilsalvo2.png"),
    offset: [1, 3],
  },
  {
    id: "3",
    title: "Seus direitos reprodutivos no SUS",
    color: "#D9B98F",
    image: require("../../assets/perfilsalvo3.png"),
    offset: [4, 3],
  },
];

const PUBLICACOES = [
  {
    id: "1",
    tag: "Dúvidas",
    tagBg: "#F8EFE8",
    tagColor: "#6B4550",
    message: "Alguém sabe se posso pegar DIU pelo SUS sem ter filhos? Perguntando por uma amiga 😅",
    time: "Há 2 dias",
    likes: 12,
    replies: 2,
    shares: 12,
  },
  {
    id: "2",
    tag: "Desabafo",
    tagBg: "#E8F1F8",
    tagColor: "#45576B",
    message: "Tô me sentido meio mal ultimamente, será que é sintoma da menstruação?",
    time: "Há 4 dias",
    likes: 28,
    replies: 5,
    shares: 9,
  },
];

const PREFERENCIAS = [
  {
    key: "diario",
    image: require("../../assets/perfildiario.png"),
    size: [17, 17],
    labelKey: "diario",
    route: null,
  },
  {
    key: "filtros",
    image: require("../../assets/perfilfiltros.png"),
    size: [17, 15],
    labelKey: "filtros",
    subtitleKey: "filtros",
    route: "FiltrosInteresse",
  },
  {
    key: "notificacoes",
    image: require("../../assets/perfilnotificacoes.png"),
    size: [17, 17],
    labelKey: "notificacoes",
    route: "Notificacoes",
  },
  {
    key: "configuracoes",
    image: require("../../assets/perfilconfiguracoes.png"),
    size: [17, 18],
    labelKey: "configuracoes",
    route: "Configuracoes",
  },
];

// áreas clicáveis sobre a imagem do rodapé (larguras proporcionais)
const TABS = [
  { key: "Home", label: "Home", icon: "home-outline", flex: 62, route: "Home" },
  { key: "Diario", label: "Diário", icon: "calendar-outline", flex: 58, route: null },
  { key: "Mapa", label: "Mapa", icon: "location-outline", flex: 69, route: null },
  { key: "Mensagens", label: "Mensagens", icon: "chatbubble-outline", flex: 79, route: null },
  { key: "Comunidade", label: "Comunidade", icon: "people-outline", flex: 76, route: null },
  { key: "Perfil", label: "Perfil", icon: "person-outline", flex: 68, route: null },
];

export default function Perfil({ route, navigation }) {

  const { user } = useAuth();
  const { colors, preferences, fontScale } = usePreferences();
  const idioma = preferences.idiomaUsuario || 'pt-BR';
  const strings = PROFILE_TEXTS[idioma] || PROFILE_TEXTS['pt-BR'];
  const id = route?.params?.id ?? user?.codUsuario ?? user?.id;

  const [usuario, setUsuario] = useState(null);

  const [loading, setLoading] = useState(true);

  const { width } = useWindowDimensions();

  const [fontsLoaded] = useFonts({
    BricolageGrotesque_700Bold,
    BricolageGrotesque_800ExtraBold,
    Nunito_400Regular,
    Nunito_500Medium,
    Nunito_600SemiBold,
    Nunito_700Bold,
  });

  const carregarPerfil = async () => {
    if (!id) { setUsuario(null); setLoading(false); return; }
    setLoading(true);
    try {

      const response = await api.get(
        `/usuario/${id}`
      );

      const usuarioData = response.data?.usuario || response.data;
      setUsuario(usuarioData);

    } catch (error) {

      console.log(
        "ERRO PERFIL:",
        error.response?.data
      );

      Alert.alert(
        strings.errorTitle,
        strings.errorLoad
      );

    } finally {

      setLoading(false);

    }
  };

  // Recarrega os dados sempre que a tela volta a ficar em foco (ex.: depois de editar
  // o perfil ou trocar a foto). O evento "focus" também dispara na primeira abertura.
  useEffect(() => {

    const cancelar = navigation.addListener("focus", carregarPerfil);

    return cancelar;

  }, [navigation]);

  if (!fontsLoaded) return null;

  {

    if (loading) {

      return (
        <View style={commonStyles.centered}>
          <ScaledText style={commonStyles.title}>
            {strings.loading}
          </ScaledText>
        </View>
      );

    }

    if (!usuario) {

      return (
        <View style={commonStyles.centered}>
          <ScaledText style={commonStyles.title}>
            {strings.notFound}
          </ScaledText>
        </View>
      );

    }

  }

  const dados = usuario;
  const nome = dados?.nomeUsuario || "";
  const fotoPerfilAtual = dados?.fotoPerfilUsuario || user?.fotoPerfilUsuario;
  const inicial = (nome.trim().charAt(0) || "A").toUpperCase();
  const stats = ESTATISTICAS.map((item) => ({ ...item, label: strings.stats.find((entry) => entry.key === item.key)?.label || item.label }));
  const preferencias = PREFERENCIAS.map((item) => ({
    ...item,
    label: strings.prefLabels[item.labelKey],
    subtitle: item.subtitleKey ? strings.prefSubtitles[item.subtitleKey] : null,
  }));

  // Ajusta o espaço conforme o texto: fontes menores aproximam o card, maiores
  // reservam mais área para o nome e a bio.
  const overlapRatio = 0.26 - ((fontScale - 0.9) / 0.25) * 0.09;
  const cardOverlap = width * Math.min(0.26, Math.max(0.17, overlapRatio));
  const topInset = Platform.OS === "android" ? StatusBar.currentHeight || 0 : 0;

  const editarPerfil = () => { if (!dados?.codUsuario) return Alert.alert("Perfil", strings.errorLoad); navigation.navigate("EditarPerfil", { id: dados.codUsuario }); };

  return (

    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>

      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
      >

        {/* HEADER */}
        <ImageBackground
          source={require("../../assets/homeheader.png")}
          style={[styles.header, { paddingTop: 15 + topInset }]}
          resizeMode="stretch"
        >

          <View style={styles.avatar}>
            {fotoPerfilAtual ? (
              <Image
                source={{ uri: urlFoto(fotoPerfilAtual) }}
                style={styles.avatarImage}
                resizeMode="cover"
              />
            ) : (
              <ScaledText style={styles.avatarLetter}>{inicial}</ScaledText>
            )}
          </View>

          <ScaledText style={styles.name}>{nome}</ScaledText>
          <ScaledText style={styles.bio}>{strings.bio}</ScaledText>

          <TouchableOpacity
            style={[styles.editButton, { top: 18 + topInset }]}
            onPress={editarPerfil}
            activeOpacity={0.8}
            accessibilityRole="button"
            accessibilityLabel={strings.edit}
          >
            <Image
              source={require("../../assets/perfileditar.png")}
              style={styles.editIcon}
            />
          </TouchableOpacity>

        </ImageBackground>

        <View style={[styles.content, { marginTop: -cardOverlap }]}>

          {/* NÚMEROS */}
          <View style={[styles.statsCard, { backgroundColor: colors.card, borderColor: colors.border }]}>
            {stats.map((item, index) => (
              <React.Fragment key={item.key}>
                {index > 0 && <View style={[styles.statsDivider, { backgroundColor: colors.border }]} />}
                <View style={styles.statItem}>
                  <ScaledText style={[styles.statValue, { color: colors.text }]}>{item.valor}</ScaledText>
                  <ScaledText style={[styles.statLabel, { color: colors.muted }]}>{item.label}</ScaledText>
                </View>
              </React.Fragment>
            ))}
          </View>

          {/* MEUS SALVOS */}
          <View style={styles.sectionHeaderRow}>
            <ScaledText style={[styles.sectionTitle, { color: colors.text }]}>{strings.saved}</ScaledText>
            <TouchableOpacity>
              <ScaledText style={[styles.linkText, { color: colors.wine }]}>{strings.seeAll}</ScaledText>
            </TouchableOpacity>
          </View>

        </View>

        <ScrollView
          horizontal
          showsHorizontalScrollIndicator={false}
          contentContainerStyle={styles.savedList}
        >
          {SALVOS.map((item) => (
            <TouchableOpacity key={item.id} style={styles.savedItem} activeOpacity={0.8}>
              <View style={[styles.savedCard, { backgroundColor: item.color }]}>
                <Image
                  source={item.image}
                  style={[
                    styles.savedIcon,
                    { left: item.offset[0], top: item.offset[1] },
                  ]}
                />
              </View>
              <ScaledText style={[styles.savedTitle, { color: colors.text }]} numberOfLines={2}>
                {item.title}
              </ScaledText>
            </TouchableOpacity>
          ))}
        </ScrollView>

        <View style={styles.content}>

          {/* MINHAS PUBLICAÇÕES */}
          <View style={styles.sectionHeaderRow}>
            <ScaledText style={[styles.sectionTitle, { color: colors.text }]}>{strings.publications}</ScaledText>
            <TouchableOpacity>
              <ScaledText style={[styles.linkText, { color: colors.wine }]}>{strings.seeAll}</ScaledText>
            </TouchableOpacity>
          </View>

          {PUBLICACOES.map((pub) => (
            <View key={pub.id} style={[styles.postCard, { backgroundColor: colors.card, borderColor: colors.border }]}> 
              <View style={[styles.postTag, { backgroundColor: pub.tagBg }]}> 
                <ScaledText style={[styles.postTagText, { color: pub.tagColor }]}>
                  {strings.tag[pub.tag.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '')] || pub.tag}
                </ScaledText>
              </View>

              <ScaledText style={[styles.postMessage, { color: colors.text }]}>{pub.message}</ScaledText>

              <View style={styles.postFooter}>
                <ScaledText style={[styles.postTime, { color: colors.muted }]}>{pub.time}</ScaledText>
                <View style={styles.postAction}>
                  <Ionicons name="heart-outline" size={14} color={colors.muted} />
                  <ScaledText style={[styles.postActionText, { color: colors.muted }]}>{pub.likes}</ScaledText>
                </View>
                <View style={styles.postAction}>
                  <Ionicons name="chatbubble-outline" size={13} color={colors.muted} />
                  <ScaledText style={[styles.postActionText, { color: colors.muted }]}>{pub.replies}</ScaledText>
                </View>
                <View style={styles.postAction}>
                  <Ionicons name="repeat-outline" size={15} color={colors.muted} />
                  <ScaledText style={[styles.postActionText, { color: colors.muted }]}>{pub.shares}</ScaledText>
                </View>
              </View>
            </View>
          ))}

          {/* PREFERÊNCIAS */}
          <ScaledText style={[styles.sectionTitle, styles.preferencesTitle, { color: colors.text }]}>{strings.preferences}</ScaledText>

          <View style={[styles.preferencesCard, { backgroundColor: colors.card, borderColor: colors.border }]}> 
            {preferencias.map((item, index) => (
              <TouchableOpacity
                key={item.key}
                style={[styles.prefRow, index > 0 && [styles.prefRowDivider, { borderTopColor: colors.border }]]}
                activeOpacity={0.7}
                onPress={() => item.route && navigation.navigate(item.route)}
                accessibilityRole="button"
                accessibilityLabel={item.label}
              >
                <View style={[styles.prefIconBox, { backgroundColor: colors.iconBg }]}>
                  <Image
                    source={item.image}
                    style={{ width: item.size[0], height: item.size[1] }}
                    resizeMode="contain"
                  />
                </View>

                <View style={styles.prefTexts}>
                  <ScaledText style={[styles.prefLabel, { color: colors.text }]}>{item.label}</ScaledText>
                  {item.subtitle ? (
                    <ScaledText style={[styles.prefSubtitle, { color: colors.muted }]}>{item.subtitle}</ScaledText>
                  ) : null}
                </View>

                <Ionicons name="chevron-forward" size={16} color={colors.wine} />
              </TouchableOpacity>
            ))}
          </View>

        </View>

      </ScrollView>

      <AppTabBar
        image={require("../../assets/perfilfooter.png")}
        tabs={TABS}
        activeKey="Perfil"
        onTabPress={(tab) => {
          if (tab.route === "Home") {
            navigation.navigate("Home");
          }
        }}
      />

    </SafeAreaView>

  );
}

const cardShadow = {
  shadowColor: "#AA1B31",
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
    paddingBottom: 27,
  },

  /* Header */
  header: {
    width: "100%",
    aspectRatio: 412 / 307,
    alignItems: "center",
  },
  avatar: {
    width: 72,
    height: 72,
    borderRadius: 36,
    backgroundColor: COLORS.wine,
    alignItems: "center",
    justifyContent: "center",
    overflow: "hidden",
  },
  avatarImage: {
    width: "100%",
    height: "100%",
  },
  avatarLetter: {
    fontSize: 30,
    fontFamily: FONT.titleExtra,
    color: COLORS.white,
  },
  name: {
    fontSize: 24,
    lineHeight: 30,
    fontFamily: FONT.titleExtra,
    color: COLORS.white,
    marginTop: 10,
    maxWidth: '82%',
    textAlign: 'center',
  },
  bio: {
    fontSize: 12,
    lineHeight: 16,
    fontFamily: FONT.regular,
    color: "rgba(255,255,255,0.85)",
    marginTop: 4,
  },
  editButton: {
    position: "absolute",
    right: 15,
    width: 40,
    height: 40,
  },
  editIcon: {
    width: 40,
    height: 40,
  },

  content: {
    paddingHorizontal: 16,
  },

  /* Números */
  statsCard: {
    flexDirection: "row",
    alignItems: "center",
    height: 82,
    backgroundColor: COLORS.white,
    borderRadius: 22,
    borderWidth: 1,
    borderColor: COLORS.border,
    ...cardShadow,
  },
  statItem: {
    flex: 1,
    alignItems: "center",
    justifyContent: "center",
  },
  statsDivider: {
    width: 1,
    height: 62,
    backgroundColor: COLORS.border,
  },
  statValue: {
    fontSize: 22,
    lineHeight: 26,
    fontFamily: FONT.titleExtra,
    color: COLORS.ink,
  },
  statLabel: {
    fontSize: 11,
    lineHeight: 15,
    fontFamily: FONT.regular,
    color: "#93707B",
    marginTop: 2,
  },

  /* Seções */
  sectionHeaderRow: {
    flexDirection: "row",
    justifyContent: "space-between",
    alignItems: "center",
    marginTop: 20,
    marginBottom: 10,
  },
  sectionTitle: {
    fontSize: 21,
    fontFamily: FONT.titleExtra,
    color: COLORS.ink,
  },
  linkText: {
    fontSize: 12,
    fontFamily: FONT.titleBold,
    color: COLORS.wine,
  },

  /* Salvos */
  savedList: {
    paddingHorizontal: 16,
  },
  savedItem: {
    width: 120,
    marginRight: 22,
  },
  savedCard: {
    width: 120,
    height: 80,
    borderRadius: 16,
    overflow: "hidden",
  },
  savedIcon: {
    position: "absolute",
    width: 50,
    height: 50,
  },
  savedTitle: {
    width: 134,
    marginTop: 10,
    fontSize: 13,
    lineHeight: 17,
    fontFamily: FONT.semibold,
    color: COLORS.ink,
  },

  /* Publicações */
  postCard: {
    backgroundColor: COLORS.white,
    borderRadius: 18,
    borderWidth: 1,
    borderColor: COLORS.border,
    paddingVertical: 12,
    paddingHorizontal: 14,
    marginBottom: 11,
  },
  postTag: {
    alignSelf: "flex-start",
    borderRadius: 8,
    paddingHorizontal: 10,
    paddingVertical: 3,
    marginBottom: 9,
  },
  postTagText: {
    fontSize: 11,
    fontFamily: FONT.bold,
  },
  postMessage: {
    fontSize: 13.5,
    lineHeight: 18,
    fontFamily: FONT.regular,
    color: COLORS.ink,
    marginBottom: 9,
  },
  postFooter: {
    flexDirection: "row",
    alignItems: "center",
  },
  postTime: {
    fontSize: 11,
    fontFamily: FONT.regular,
    color: COLORS.muted,
    marginRight: 16,
  },
  postAction: {
    flexDirection: "row",
    alignItems: "center",
    marginRight: 16,
  },
  postActionText: {
    fontSize: 11,
    fontFamily: FONT.regular,
    color: COLORS.mutedDark,
    marginLeft: 5,
  },

  /* Preferências */
  preferencesTitle: {
    marginTop: 8,
    marginBottom: 10,
  },
  preferencesCard: {
    backgroundColor: COLORS.white,
    borderRadius: 20,
    borderWidth: 1,
    borderColor: COLORS.border,
    paddingHorizontal: 16,
  },
  prefRow: {
    flexDirection: "row",
    alignItems: "center",
    minHeight: 71,
  },
  prefRowDivider: {
    borderTopWidth: 1,
    borderTopColor: COLORS.border,
  },
  prefIconBox: {
    width: 40,
    height: 40,
    borderRadius: 10,
    backgroundColor: COLORS.iconBox,
    alignItems: "center",
    justifyContent: "center",
    marginRight: 12,
  },
  prefTexts: {
    flex: 1,
  },
  prefLabel: {
    fontSize: 15,
    fontFamily: FONT.titleBold,
    color: COLORS.ink,
  },
  prefSubtitle: {
    fontSize: 11,
    fontFamily: FONT.regular,
    color: "#8C6672",
    marginTop: 2,
  },

});
