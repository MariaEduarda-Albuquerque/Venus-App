import { Text as ScaledText } from '../../context/ScaledText';
import { useState, useEffect } from 'react';
import {
  SafeAreaView,
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  View
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { Alert } from 'react-native';
import { usePreferences } from '../../context/PreferencesContext';
import {
  Card,
  COLORS,
  FONT,
  ScreenHeader,
  Section,
  ToggleRow,
  useConfigFonts,
} from './ConfigUI';

const SLIDER_THUMB = 18;

const TEXTS = {
  'pt-BR': {
    title: 'Aparência e idioma',
    tema: 'Tema do app',
    fonte: 'Tamanho da fonte',
    contraste: 'Alto contraste',
    idioma: 'Idioma',
    preview: 'Exemplo de leitura com tamanho ajustado',
    temaLabels: [
      { key: 'claro', label: 'Claro' },
      { key: 'escuro', label: 'Escuro' },
      { key: 'sistema', label: 'Sistema' },
    ],
    idiomas: [
      { key: 'pt-BR', label: 'Português (Brasil)' },
      { key: 'es', label: 'Español' },
      { key: 'en', label: 'English' },
    ],
  },
  es: {
    title: 'Apariencia e idioma',
    tema: 'Tema de la app',
    fonte: 'Tamaño de la fuente',
    contraste: 'Alto contraste',
    idioma: 'Idioma',
    preview: 'Ejemplo de lectura con tamaño ajustado',
    temaLabels: [
      { key: 'claro', label: 'Claro' },
      { key: 'escuro', label: 'Oscuro' },
      { key: 'sistema', label: 'Sistema' },
    ],
    idiomas: [
      { key: 'pt-BR', label: 'Português (Brasil)' },
      { key: 'es', label: 'Español' },
      { key: 'en', label: 'English' },
    ],
  },
  en: {
    title: 'Appearance and language',
    tema: 'App theme',
    fonte: 'Font size',
    contraste: 'High contrast',
    idioma: 'Language',
    preview: 'Reading preview with adjusted size',
    temaLabels: [
      { key: 'claro', label: 'Light' },
      { key: 'escuro', label: 'Dark' },
      { key: 'sistema', label: 'System' },
    ],
    idiomas: [
      { key: 'pt-BR', label: 'Português (Brasil)' },
      { key: 'es', label: 'Español' },
      { key: 'en', label: 'English' },
    ],
  },
};

function FontSlider({ value, onChange, onComplete }) {
  const [trackWidth, setTrackWidth] = useState(0);
  const usable = Math.max(trackWidth - SLIDER_THUMB, 1);

  function updateFromTouch(event) {
    const x = event.nativeEvent.locationX - SLIDER_THUMB / 2;
    onChange(Math.min(1, Math.max(0, x / usable)));
  }

  return (
    <View
      style={styles.sliderTouch}
      onLayout={(e) => setTrackWidth(e.nativeEvent.layout.width)}
      onStartShouldSetResponder={() => true}
      onMoveShouldSetResponder={() => true}
      onResponderGrant={updateFromTouch}
      onResponderMove={updateFromTouch}
      onResponderRelease={onComplete}
    >
      <View style={styles.sliderTrack} pointerEvents="none" />
      <View
        pointerEvents="none"
        style={[styles.sliderFill, { width: value * usable + SLIDER_THUMB / 2 }]}
      />
      <View pointerEvents="none" style={[styles.sliderThumb, { left: value * usable }]} />
    </View>
  );
}

export default function Aparencia({ onVoltar }) {
  const fontsLoaded = useConfigFonts();
  const { preferences, updatePreferences, colors, dark, highContrast } = usePreferences();
  const tema = preferences.temaUsuario || 'claro';
  const savedFontSize = Number(preferences.tamanhoFonteUsuario ?? 0.25);
  const fontSize = Number.isFinite(savedFontSize)
    ? Math.min(1, Math.max(0, savedFontSize))
    : 0.25;
  const altoContraste = !!preferences.altoContrasteUsuario;
  const idioma = preferences.idiomaUsuario || 'pt-BR';
  const strings = TEXTS[idioma] || TEXTS['pt-BR'];
  const TEMAS = strings.temaLabels;
  const IDIOMAS = strings.idiomas;
  const [fontDraft, setFontDraft] = useState(fontSize);
  useEffect(() => setFontDraft(fontSize), [fontSize]);

  const previewTextStyle = {
    color: colors.text,
    fontSize: 13,
    fontFamily: FONT.medium,
  };

  async function save(patch) {
    try { await updatePreferences(patch); }
    catch (error) { Alert.alert('Não foi possível salvar', error.response?.data?.message || 'Confira a conexão com a API e tente novamente.'); }
  }

  if (!fontsLoaded) return null;

  return (
    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>
      <ScreenHeader title={strings.title} onBack={onVoltar} />

      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
      >
        <Section title={strings.tema}>
          <View style={[styles.segmented, { backgroundColor: colors.iconBg }]}> 
            {TEMAS.map((t) => {
              const ativo = tema === t.key;
              return (
                <TouchableOpacity
                  key={t.key}
                  style={[styles.segment, ativo && { backgroundColor: colors.wine }, ativo && styles.segmentActive]}
                  activeOpacity={0.8}
                  onPress={() => save({ temaUsuario: t.key })}
                  accessibilityRole="button"
                  accessibilityState={{ selected: ativo }}
                >
                  <ScaledText style={[styles.segmentText, { color: ativo ? '#FFFFFF' : colors.wine }, ativo && styles.segmentTextActive]}>
                    {t.label}
                  </ScaledText>
                </TouchableOpacity>
              );
            })}
          </View>
        </Section>

        <Section title={strings.fonte}>
          <Card>
            <View style={styles.fontBlock}>
              <ScaledText style={[styles.fontTitle, { color: colors.text }]}> {strings.fonte} </ScaledText>
              <View style={styles.fontSliderRow}>
                <ScaledText style={[styles.fontSmall, { color: colors.muted }]}>A</ScaledText>
                <View style={styles.sliderWrapper}>
                  <FontSlider value={fontDraft} onChange={setFontDraft} onComplete={() => save({ tamanhoFonteUsuario: Number(fontDraft.toFixed(2)) })} />
                </View>
                <ScaledText style={[styles.fontLarge, { color: colors.muted }]}>A</ScaledText>
              </View>
              <View style={[styles.previewBox, { backgroundColor: colors.iconBg, borderColor: colors.border }]}> 
                <ScaledText style={previewTextStyle}>{strings.preview}</ScaledText>
              </View>
            </View>
            <ToggleRow
              label={strings.contraste}
              value={altoContraste}
              onValueChange={(value) => save({ altoContrasteUsuario: value })}
            />
          </Card>
        </Section>

        <Section title={strings.idioma}>
          <Card>
            {IDIOMAS.map((item, index) => {
              const ativo = idioma === item.key;
              return (
                <TouchableOpacity
                  key={item.key}
                  style={[styles.langRow, { backgroundColor: colors.card }, index > 0 && styles.langDivider]}
                  activeOpacity={0.7}
                  onPress={() => save({ idiomaUsuario: item.key })}
                  accessibilityRole="radio"
                  accessibilityState={{ selected: ativo }}
                >
                  <ScaledText style={[styles.langLabel, { color: colors.text }]}>{item.label}</ScaledText>
                  <View style={[styles.check, ativo && styles.checkActive, { backgroundColor: ativo ? colors.iconBg : 'transparent' }]}>
                    <Ionicons
                      name="checkmark"
                      size={ativo ? 18 : 16}
                      color={ativo ? (dark ? '#1A0D12' : colors.wine) : (dark ? '#F4C7D6' : '#F3C5D0')}
                    />
                  </View>
                </TouchableOpacity>
              );
            })}
          </Card>
        </Section>
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

  /* Tema */
  segmented: {
    flexDirection: 'row',
    backgroundColor: COLORS.iconBg,
    borderRadius: 22,
    padding: 3,
  },
  segment: {
    flex: 1,
    height: 34,
    borderRadius: 17,
    alignItems: 'center',
    justifyContent: 'center',
  },
  segmentActive: {
    backgroundColor: COLORS.wine,
  },
  segmentText: {
    fontSize: 11,
    fontFamily: FONT.bold,
    color: COLORS.wine,
  },
  segmentTextActive: {
    color: COLORS.white,
  },

  /* Tamanho da fonte */
  fontBlock: {
    paddingTop: 16,
    paddingBottom: 12,
    paddingHorizontal: 15,
  },
  fontTitle: {
    fontSize: 14,
    fontFamily: FONT.extrabold,
    color: COLORS.ink,
  },
  fontSliderRow: {
    flexDirection: 'row',
    alignItems: 'center',
    marginTop: 8,
  },
  fontSmall: {
    fontSize: 11,
    fontFamily: FONT.semibold,
    color: COLORS.muted,
  },
  fontLarge: {
    fontSize: 17,
    fontFamily: FONT.bold,
    color: COLORS.muted,
  },
  sliderWrapper: {
    flex: 1,
    marginHorizontal: 12,
  },
  previewBox: {
    marginTop: 12,
    borderWidth: 1,
    borderRadius: 12,
    paddingVertical: 10,
    paddingHorizontal: 12,
  },
  sliderTouch: {
    height: 28,
    justifyContent: 'center',
  },
  sliderTrack: {
    height: 4,
    borderRadius: 2,
    backgroundColor: '#F7DCE3',
  },
  sliderFill: {
    position: 'absolute',
    left: 0,
    height: 4,
    borderRadius: 2,
    backgroundColor: COLORS.wine,
  },
  sliderThumb: {
    position: 'absolute',
    width: SLIDER_THUMB,
    height: SLIDER_THUMB,
    borderRadius: SLIDER_THUMB / 2,
    backgroundColor: COLORS.white,
    borderWidth: 2,
    borderColor: COLORS.wine,
  },

  /* Idioma */
  langRow: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingVertical: 14,
    paddingHorizontal: 15,
    minHeight: 62,
  },
  langDivider: {
    borderTopWidth: 1,
    borderTopColor: COLORS.border,
  },
  langLabel: {
    fontSize: 14,
    fontFamily: FONT.medium,
    color: COLORS.ink,
  },
  check: {
    width: 32,
    height: 32,
    borderRadius: 8,
    alignItems: 'center',
    justifyContent: 'center',
  },
  checkActive: {
    backgroundColor: COLORS.iconBg,
  },
});
