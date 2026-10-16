import { Text as ScaledText } from '../../context/ScaledText';
import { CommonActions, useNavigation } from '@react-navigation/native';
import { SafeAreaView, ScrollView, StyleSheet, Text, TouchableOpacity, View } from 'react-native';
import { useAuth } from '../../context/AuthContext';
import { usePreferences } from '../../context/PreferencesContext';
import {
  Card,
  COLORS,
  FONT,
  Row,
  ScreenHeader,
  Section,
  useConfigFonts,
} from './ConfigUI';

const TEXTS = {
  'pt-BR': {
    configuracoes: 'Configurações',
    conta: 'Conta',
    privacidade: 'Privacidade e dados',
    preferencias: 'Preferências',
    ajuda: 'Ajuda',
    sair: 'Sair da conta',
    dadosPessoais: 'Dados pessoais e senha',
    historico: 'Histórico de conversas',
    painelPrivacidade: 'Privacidade',
    painelPrivacidadeSub: 'Anônimo na comunidade',
    temaClaro: 'Claro',
    temaEscuro: 'Escuro',
    temaSistema: 'Sistema',
    aparencia: 'Aparência e Idioma',
    notificacoes: 'Notificações',
    filtros: 'Filtros de interesse',
    centralAjuda: 'Central de ajuda',
    faleConosco: 'Fale conosco',
  },
  es: {
    configuracoes: 'Configuración',
    conta: 'Cuenta',
    privacidade: 'Privacidad y datos',
    preferencias: 'Preferencias',
    ajuda: 'Ayuda',
    sair: 'Cerrar sesión',
    dadosPessoais: 'Datos personales y contraseña',
    historico: 'Historial de conversaciones',
    painelPrivacidade: 'Privacidad',
    painelPrivacidadeSub: 'Anónimo en la comunidad',
    temaClaro: 'Claro',
    temaEscuro: 'Oscuro',
    temaSistema: 'Sistema',
    aparencia: 'Apariencia e idioma',
    notificacoes: 'Notificaciones',
    filtros: 'Filtros de interés',
    centralAjuda: 'Centro de ayuda',
    faleConosco: 'Contáctanos',
  },
  en: {
    configuracoes: 'Settings',
    conta: 'Account',
    privacidade: 'Privacy and data',
    preferencias: 'Preferences',
    ajuda: 'Help',
    sair: 'Sign out',
    dadosPessoais: 'Personal data and password',
    historico: 'Conversation history',
    painelPrivacidade: 'Privacy',
    painelPrivacidadeSub: 'Anonymous in the community',
    temaClaro: 'Light',
    temaEscuro: 'Dark',
    temaSistema: 'System',
    aparencia: 'Appearance and language',
    notificacoes: 'Notifications',
    filtros: 'Interest filters',
    centralAjuda: 'Help center',
    faleConosco: 'Contact us',
  },
};

export default function Configuracao() {
  const navigation = useNavigation();
  const { signOut } = useAuth();
  const { colors, preferences } = usePreferences();
  const fontsLoaded = useConfigFonts();
  const strings = TEXTS[preferences.idiomaUsuario || 'pt-BR'] || TEXTS['pt-BR'];

  async function handleSignOut() {
    await signOut();
    navigation.dispatch(CommonActions.reset({ index: 0, routes: [{ name: 'Inicio' }] }));
  }

  if (!fontsLoaded) return null;

  return (
    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>
      <ScreenHeader title={strings.configuracoes} />

      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
      >
        <Section title={strings.conta}>
          <Card>
            <Row
              isFirst
              icon="person-outline"
              label={strings.dadosPessoais}
              onPress={() => navigation.navigate('DadosPessoais')}
            />
            <Row icon="chatbox-outline" label={strings.historico} />
          </Card>
        </Section>

        <Section title={strings.privacidade}>
          <Card>
            <Row
              isFirst
              icon="shield-outline"
              label={strings.painelPrivacidade}
              subtitle={strings.painelPrivacidadeSub}
              onPress={() => navigation.navigate('Privacidade')}
            />
          </Card>
        </Section>

        <Section title={strings.preferencias}>
          <Card>
            <Row
              isFirst
              icon="sunny-outline"
              label={strings.aparencia}
              subtitle={`${preferences.temaUsuario === 'escuro' ? strings.temaEscuro : preferences.temaUsuario === 'sistema' ? strings.temaSistema : strings.temaClaro} · ${preferences.idiomaUsuario || 'pt-BR'}`}
              onPress={() => navigation.navigate('Aparencia')}
            />
            <Row
              icon="notifications-outline"
              label={strings.notificacoes}
              onPress={() => navigation.navigate('Notificacoes')}
            />
            <Row
              icon="heart-outline"
              label={strings.filtros}
              onPress={() => navigation.navigate('FiltrosInteresse')}
            />
          </Card>
        </Section>

        <Section title={strings.ajuda}>
          <Card>
            <Row isFirst icon="help-circle-outline" label={strings.centralAjuda} onPress={() => navigation.navigate('CentralAjuda')} />
            <Row icon="chatbox-outline" label={strings.faleConosco} onPress={() => navigation.navigate('CentralAjuda')} />
          </Card>
        </Section>

        <TouchableOpacity
          style={styles.signOutButton}
          activeOpacity={0.7}
          onPress={handleSignOut}
          accessibilityRole="button"
          accessibilityLabel={strings.sair}
        >
          <View style={[styles.signOutInner, { backgroundColor: colors.wine }]}><ScaledText style={styles.signOutText}>{strings.sair}</ScaledText><ScaledText style={styles.signOutIcon}>↗</ScaledText></View>
        </TouchableOpacity>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: COLORS.background,
  },
  scroll: {
    flex: 1,
  },
  scrollContent: {
    paddingHorizontal: 16,
    paddingTop: 18,
    paddingBottom: 40,
  },
  signOutButton: { marginTop: 14, marginBottom: 8, borderRadius: 14, overflow: 'hidden', elevation: 2 },
  signOutInner: { flexDirection: 'row', alignItems: 'center', justifyContent: 'center', paddingVertical: 15, paddingHorizontal: 20, gap: 10 },
  signOutText: { fontSize: 14, fontFamily: FONT.extrabold, color: '#FFFFFF' },
  signOutIcon: { fontSize: 16, color: '#FFFFFF', fontWeight: '700' },
});
