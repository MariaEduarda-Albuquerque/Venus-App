import { Text as ScaledText } from '../../context/ScaledText';
import { useState, useEffect } from 'react';
import { usePreferences } from '../../context/PreferencesContext';
import { Alert } from 'react-native';
import api from '../../api/api';
import { useAuth } from '../../context/AuthContext';
import {
  Image,
  Modal,
  SafeAreaView,
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  View
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import {
  Card,
  COLORS,
  FONT,
  Row,
  ScreenHeader,
  Section,
  ToggleRow,
  useConfigFonts,
} from './ConfigUI';

const GREEN = '#2F7A45';
const TEXTS = {
  'pt-BR': {
    titulo: 'Privacidade',
    quem: 'Quem pode ver meu perfil',
    detalhes: 'Detalhes',
    mostrarBio: 'Mostrar minha bio',
    permitirApoio: 'Permitir que a comunidade me apoie',
    apoioSubtitle: 'Curtidas nas minhas publicações',
    baixar: 'Baixar meus dados',
    baixarSubtitle: 'LGPD · até 15 dias',
    politica: 'Política de privacidade',
    excluir: 'Excluir minha conta',
    aviso: 'Seus dados de saúde são só seus e nunca são vendidos.',
    modalTitle: 'Excluir sua conta?',
    modalText: 'Isso exclui permanentemente sua conta. Essa ação não pode ser desfeita.',
    modalDelete: 'Excluir permanentemente',
    modalCancel: 'Cancelar',
    modalClose: 'Fechar',
  },
  es: {
    titulo: 'Privacidad',
    quem: 'Quién puede ver mi perfil',
    detalhes: 'Detalles',
    mostrarBio: 'Mostrar mi biografía',
    permitirApoio: 'Permitir que la comunidad me apoye',
    apoioSubtitle: 'Me gusta en mis publicaciones',
    baixar: 'Descargar mis datos',
    baixarSubtitle: 'LGPD · hasta 15 días',
    politica: 'Política de privacidad',
    excluir: 'Eliminar mi cuenta',
    aviso: 'Tus datos de salud son solo tuyos y nunca se venden.',
    modalTitle: '¿Eliminar tu cuenta?',
    modalText: 'Esto elimina permanentemente tu cuenta. Esta acción no se puede deshacer.',
    modalDelete: 'Eliminar permanentemente',
    modalCancel: 'Cancelar',
    modalClose: 'Cerrar',
  },
  en: {
    titulo: 'Privacy',
    quem: 'Who can see my profile',
    detalhes: 'Details',
    mostrarBio: 'Show my bio',
    permitirApoio: 'Allow the community to support me',
    apoioSubtitle: 'Likes on my posts',
    baixar: 'Download my data',
    baixarSubtitle: 'LGPD · up to 15 days',
    politica: 'Privacy policy',
    excluir: 'Delete my account',
    aviso: 'Your health data is yours alone and is never sold.',
    modalTitle: 'Delete your account?',
    modalText: 'This permanently deletes your account. This action cannot be undone.',
    modalDelete: 'Delete permanently',
    modalCancel: 'Cancel',
    modalClose: 'Close',
  },
};

const VISIBILIDADES = [
  {
    key: 'anonima',
    image: require('../../assets/privacidadeanonima.png'),
    imageSize: [18, 18],
    title: 'Ninguém, sou anônima',
    subtitle: 'Seu nome e foto não aparecem',
  },
  {
    key: 'profissionais',
    image: require('../../assets/privacidadeprofissionais.png'),
    imageSize: [21, 20],
    title: 'Só profissionais verificadas',
    subtitle: 'Para atendimento e acompanhamento',
  },
  {
    key: 'comunidade',
    image: require('../../assets/privacidadecomunidade.png'),
    imageSize: [18, 18],
    title: 'A comunidade',
    subtitle: 'Seu apelido aparece nas publicações',
  },
];

function OptionCard({ image, imageSize, title, subtitle, selected, onPress }) {
  const { colors } = usePreferences();
  return (
    <TouchableOpacity
      style={[
        styles.option,
        {
          backgroundColor: selected ? colors.selectedBg : colors.card,
          borderColor: selected ? colors.wine : colors.border,
        },
      ]}
      activeOpacity={0.8}
      onPress={onPress}
      accessibilityRole="radio"
      accessibilityState={{ selected }}
    >
      <View style={styles.optionTexts}>
        <ScaledText style={[styles.optionTitle, { color: colors.text }]}>{title}</ScaledText>
        <ScaledText style={[styles.optionSubtitle, { color: colors.muted }]}>{subtitle}</ScaledText>
      </View>
      <View style={[styles.optionIcon, { backgroundColor: selected ? colors.wine : colors.iconBg }]}>
        <Image
          source={image}
          style={{ width: imageSize[0], height: imageSize[1], tintColor: selected ? colors.white : colors.wine }}
          resizeMode="contain"
        />
      </View>
    </TouchableOpacity>
  );
}

function ExcluirContaModal({ visible, onClose, onConfirm, strings }) {
  return (
    <Modal visible={visible} transparent animationType="slide" onRequestClose={onClose}>
      <View style={styles.overlay}>
        <TouchableOpacity style={StyleSheet.absoluteFill} activeOpacity={1} onPress={onClose} />

        <View style={styles.sheet}>
          <View style={styles.sheetHandle} />

          <View style={styles.sheetHeader}>
            <ScaledText style={styles.sheetTitle}>{strings.modalTitle}</ScaledText>
            <TouchableOpacity
              style={styles.sheetClose}
              onPress={onClose}
              accessibilityRole="button"
              accessibilityLabel={strings.modalClose}
            >
              <Ionicons name="close" size={14} color={COLORS.ink} />
            </TouchableOpacity>
          </View>

          <ScaledText style={styles.sheetText}>
            {strings.modalText}
          </ScaledText>

          <TouchableOpacity
            style={styles.deleteButton}
            activeOpacity={0.85}
            onPress={onConfirm}
            accessibilityRole="button"
          >
            <ScaledText style={styles.deleteButtonText}>{strings.modalDelete}</ScaledText>
          </TouchableOpacity>

          <TouchableOpacity style={styles.cancelButton} activeOpacity={0.7} onPress={onClose}>
            <ScaledText style={styles.cancelText}>{strings.modalCancel}</ScaledText>
          </TouchableOpacity>
        </View>
      </View>
    </Modal>
  );
}

export default function Privacidade({ navigation, onVoltar }) {
  const fontsLoaded = useConfigFonts();
  const { user, signOut } = useAuth();
  const { preferences, updatePreferences, colors } = usePreferences();
  const strings = TEXTS[preferences.idiomaUsuario || 'pt-BR'] || TEXTS['pt-BR'];
  const [visibilidade, setVisibilidade] = useState(preferences.visibilidadePerfilUsuario || 'anonima');
  const [mostrarBio, setMostrarBio] = useState(!!preferences.mostrarBioUsuario);
  const [permitirApoio, setPermitirApoio] = useState(preferences.permitirApoioUsuario !== false);
  useEffect(() => { setVisibilidade(preferences.visibilidadePerfilUsuario || 'anonima'); setMostrarBio(!!preferences.mostrarBioUsuario); setPermitirApoio(preferences.permitirApoioUsuario !== false); }, [preferences.visibilidadePerfilUsuario, preferences.mostrarBioUsuario, preferences.permitirApoioUsuario]);
  async function salvarPrivacidade(patch) {
    try { await updatePreferences(patch); }
    catch (error) { Alert.alert('Erro ao salvar', error.response?.data?.message || 'Não foi possível salvar a preferência.'); }
  }
  const [excluirVisivel, setExcluirVisivel] = useState(false);

  async function confirmarExclusao() {
    const id = user?.codUsuario ?? user?.id;
    if (!id) {
      setExcluirVisivel(false);
      Alert.alert('Sessão necessária', 'Entre na sua conta novamente para excluir o perfil.');
      return;
    }
    try {
      await api.delete(`/usuario/${id}`);
      setExcluirVisivel(false);
      await signOut();
      navigation?.reset({ index: 0, routes: [{ name: 'Login' }] });
      Alert.alert('Conta excluída', 'Sua conta foi excluída com sucesso.');
    } catch (error) {
      setExcluirVisivel(false);
      Alert.alert('Erro', error.response?.data?.message || 'Não foi possível excluir a conta. Tente novamente.');
    }
  }

  if (!fontsLoaded) return null;

  return (
    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>
      <ScreenHeader title={strings.titulo} onBack={onVoltar} />

      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
      >
        <Section title={strings.quem} style={styles.optionsSection}>
          {VISIBILIDADES.map((op) => (
            <OptionCard
              key={op.key}
              image={op.image}
              imageSize={op.imageSize}
              title={op.title}
              subtitle={op.subtitle}
              selected={visibilidade === op.key}
              onPress={() => { setVisibilidade(op.key); salvarPrivacidade({ visibilidadePerfilUsuario: op.key, anonimaPadraoUsuario: op.key === 'anonima' }); }}
            />
          ))}
        </Section>

        <Section title={strings.detalhes}>
          <Card>
            <ToggleRow
              isFirst
              label={strings.mostrarBio}
              value={mostrarBio}
              onValueChange={(value) => { setMostrarBio(value); salvarPrivacidade({ mostrarBioUsuario: value }); }}
            />
            <ToggleRow
              label={strings.permitirApoio}
              subtitle={strings.apoioSubtitle}
              value={permitirApoio}
              onValueChange={(value) => { setPermitirApoio(value); salvarPrivacidade({ permitirApoioUsuario: value }); }}
            />
          </Card>
        </Section>

        <Section title={strings.quem}>
          <Card>
            <Row
              isFirst
              image={require('../../assets/privacidadepolitica.png')}
              imageSize={[20, 18]}
              label={strings.politica}
              onPress={() => navigation?.navigate('PoliticaPrivacidade')}
            />
            <Row
              danger
              image={require('../../assets/privacidadeexcluir.png')}
              imageSize={[15, 16]}
              label={strings.excluir}
              onPress={() => setExcluirVisivel(true)}
            />
          </Card>
        </Section>

        <View style={[styles.note, { backgroundColor: colors.card }]}>
          <Ionicons name="shield" size={13} color={GREEN} />
          <ScaledText style={[styles.noteText, { color: colors.text }]}>{strings.aviso}</ScaledText>
        </View>
      </ScrollView>

      <ExcluirContaModal
        visible={excluirVisivel}
        onClose={() => setExcluirVisivel(false)}
        onConfirm={confirmarExclusao}
        strings={strings}
      />
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
    paddingTop: 12,
    paddingBottom: 40,
  },

  /* Opções de visibilidade */
  optionsSection: {
    marginBottom: 16,
  },
  option: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: COLORS.white,
    borderRadius: 16,
    borderWidth: 1,
    borderColor: COLORS.border,
    paddingVertical: 14,
    paddingHorizontal: 15,
    marginBottom: 10,
  },
  optionTexts: {
    flex: 1,
    paddingRight: 10,
  },
  optionTitle: {
    fontSize: 14,
    fontFamily: FONT.semibold,
    color: COLORS.ink,
  },
  optionSubtitle: {
    fontSize: 11,
    fontFamily: FONT.regular,
    color: COLORS.muted,
    marginTop: 3,
  },
  optionIcon: {
    width: 36,
    height: 36,
    borderRadius: 10,
    backgroundColor: COLORS.iconBg,
    alignItems: 'center',
    justifyContent: 'center',
  },

  /* Aviso */
  note: {
    flexDirection: 'row',
    alignItems: 'center',
    alignSelf: 'center',
    backgroundColor: '#E3F1E6',
    borderRadius: 8,
    paddingVertical: 9,
    paddingHorizontal: 12,
    marginTop: 4,
  },
  noteText: {
    fontSize: 11,
    fontFamily: FONT.semibold,
    color: GREEN,
    marginLeft: 8,
  },

  /* Popup excluir conta */
  overlay: {
    flex: 1,
    justifyContent: 'flex-end',
    backgroundColor: 'rgba(58, 22, 32, 0.45)',
  },
  sheet: {
    backgroundColor: COLORS.white,
    borderTopLeftRadius: 28,
    borderTopRightRadius: 28,
    paddingHorizontal: 24,
    paddingTop: 12,
    paddingBottom: 34,
  },
  sheetHandle: {
    alignSelf: 'center',
    width: 36,
    height: 4,
    borderRadius: 2,
    backgroundColor: '#E8CDD3',
    marginBottom: 20,
  },
  sheetHeader: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    marginBottom: 14,
  },
  sheetTitle: {
    fontSize: 18,
    fontFamily: FONT.extrabold,
    color: COLORS.ink,
  },
  sheetClose: {
    width: 24,
    height: 24,
    borderRadius: 12,
    backgroundColor: '#FBE0E6',
    alignItems: 'center',
    justifyContent: 'center',
  },
  sheetText: {
    fontSize: 13,
    lineHeight: 19,
    fontFamily: FONT.regular,
    color: COLORS.muted,
    marginBottom: 20,
  },
  deleteButton: {
    backgroundColor: COLORS.wine,
    borderRadius: 16,
    paddingVertical: 15,
    alignItems: 'center',
  },
  deleteButtonText: {
    fontSize: 15,
    fontFamily: FONT.extrabold,
    color: COLORS.white,
  },
  cancelButton: {
    alignSelf: 'center',
    paddingVertical: 10,
    paddingHorizontal: 20,
    marginTop: 14,
  },
  cancelText: {
    fontSize: 14,
    fontFamily: FONT.semibold,
    color: COLORS.muted,
  },
});
