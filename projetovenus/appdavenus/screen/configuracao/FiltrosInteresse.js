import { Text as ScaledText } from '../../context/ScaledText';
import { useState, useEffect } from 'react';
import { Alert } from 'react-native';
import { usePreferences } from '../../context/PreferencesContext';
import {
  SafeAreaView,
  ScrollView,
  StyleSheet,
  Text,
  TouchableOpacity,
  useWindowDimensions,
  View
} from 'react-native';
import {
  Card,
  COLORS,
  FONT,
  ScreenHeader,
  Section,
  ToggleRow,
  useConfigFonts,
} from './ConfigUI';

const TEXTS = {
  'pt-BR': {
    title: 'Filtros de interesse', clear: 'Limpar', save: 'Salvar', saved: 'Seus filtros de interesse foram atualizados.', feedTitle: 'Personalizar seu feed',
    description: 'Escolha os temas que mais importam pra você. Dá pra mudar quando quiser.',
    sensivel: 'Ocultar conteúdo sensível',
  },
  es: {
    title: 'Filtros de interés', clear: 'Limpiar', save: 'Guardar', saved: 'Tus filtros de interés se actualizaron.', feedTitle: 'Personaliza tu feed',
    description: 'Elige los temas que más te importan. Puedes cambiarlo cuando quieras.',
    sensivel: 'Ocultar contenido sensible',
  },
  en: {
    title: 'Interest filters', clear: 'Clear', save: 'Save', saved: 'Your interest filters have been updated.', feedTitle: 'Personalize your feed',
    description: 'Choose the topics that matter most to you. You can change it anytime.',
    sensivel: 'Hide sensitive content',
  },
};

const TEMAS = [
  'Gravidez',
  'ISTs e prevenção',
  'Menopausa',
  'Contracepção',
  'Saúde mental',
  'Higiene',
  'Ciclo menstrual',
  'Violência e acolhimento',
];

const SELECIONADOS_INICIAIS = ['Gravidez', 'Saúde mental', 'Higiene', 'Violência e acolhimento'];

const COLUNAS = 3;
const GAP = 8;
const PADDING = 16;

export default function FiltrosInteresse({ onVoltar }) {
  const fontsLoaded = useConfigFonts();
  const { width } = useWindowDimensions();
  const { preferences, updatePreferences, colors } = usePreferences();
  const strings = TEXTS[preferences.idiomaUsuario || 'pt-BR'] || TEXTS['pt-BR'];
  const [selecionados, setSelecionados] = useState(preferences.filtrosInteresseUsuario || SELECIONADOS_INICIAIS);
  const [ocultarSensivel, setOcultarSensivel] = useState(!!preferences.ocultarSensivelUsuario);
  useEffect(() => { setSelecionados(preferences.filtrosInteresseUsuario || SELECIONADOS_INICIAIS); setOcultarSensivel(!!preferences.ocultarSensivelUsuario); }, [preferences.filtrosInteresseUsuario, preferences.ocultarSensivelUsuario]);

  const chipWidth = (width - PADDING * 2 - GAP * (COLUNAS - 1)) / COLUNAS;

  function alternarTema(tema) {
    setSelecionados((atuais) => atuais.includes(tema) ? atuais.filter((t) => t !== tema) : [...atuais, tema]);
  }
  async function salvarFiltros() {
    try { await updatePreferences({ filtrosInteresseUsuario: selecionados, ocultarSensivelUsuario: ocultarSensivel }); Alert.alert(strings.save, strings.saved); }
    catch (error) { Alert.alert('Erro ao salvar', 'Não foi possível salvar os filtros na API.'); }
  }
  function alterarSensivel(valor) { setOcultarSensivel(valor); }

  if (!fontsLoaded) return null;

  return (
    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>
      <ScreenHeader title={strings.title} onBack={onVoltar} />

      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
      >
        <View style={styles.actionsRow}>
          <TouchableOpacity style={[styles.clearButton, { borderColor: colors.wine }]} onPress={() => { setSelecionados([]); setOcultarSensivel(false); }}><ScaledText style={[styles.clearButtonText, { color: colors.wine }]}>{strings.clear}</ScaledText></TouchableOpacity>
          <TouchableOpacity style={[styles.saveButton, { backgroundColor: colors.wine }]} onPress={salvarFiltros}><ScaledText style={styles.saveButtonText}>{strings.save}</ScaledText></TouchableOpacity>
        </View>
        <Section title={strings.feedTitle} style={styles.feedSection}>
          <ScaledText style={[styles.description, { color: colors.text }]}>
            {strings.description}
          </ScaledText>

          <View style={styles.chips}>
            {TEMAS.map((tema, index) => {
              const ativo = selecionados.includes(tema);
              const ultimaColuna = index % COLUNAS === COLUNAS - 1;
              return (
                <TouchableOpacity
                  key={tema}
                  activeOpacity={0.8}
                  onPress={() => alternarTema(tema)}
                  accessibilityRole="button"
                  accessibilityState={{ selected: ativo }}
                  style={[
                    styles.chip,
                    { width: chipWidth, marginRight: ultimaColuna ? 0 : GAP },
                    {
                      backgroundColor: ativo ? colors.wine : colors.card,
                      borderColor: ativo ? colors.wine : colors.border,
                    },
                  ]}
                >
                  <ScaledText
                    style={[styles.chipText, { color: ativo ? colors.white : colors.text }]}
                    numberOfLines={1}
                  >
                    {tema}
                  </ScaledText>
                </TouchableOpacity>
              );
            })}
          </View>
        </Section>

        <Section title="Preferências">
          <Card>
            <ToggleRow
              isFirst
              label={strings.sensivel}
              value={ocultarSensivel}
              onValueChange={alterarSensivel}
            />
          </Card>
        </Section>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  actionsRow: { flexDirection: 'row', justifyContent: 'flex-end', gap: 10, marginBottom: 14 },
  clearButton: { paddingVertical: 10, paddingHorizontal: 18, borderWidth: 1, borderRadius: 12 },
  clearButtonText: { fontFamily: FONT.bold, fontSize: 13 },
  saveButton: { paddingVertical: 10, paddingHorizontal: 24, borderRadius: 12 },
  saveButtonText: { color: '#FFFFFF', fontFamily: FONT.bold, fontSize: 13 },
  container: {
    flex: 1,
    backgroundColor: COLORS.background,
  },
  scroll: {
    flex: 1,
  },
  scrollContent: {
    paddingHorizontal: PADDING,
    paddingTop: 18,
    paddingBottom: 40,
  },
  feedSection: {
    marginBottom: 14,
  },
  description: {
    fontSize: 13,
    lineHeight: 18,
    fontFamily: FONT.medium,
    color: COLORS.ink,
    marginBottom: 12,
  },
  chips: {
    flexDirection: 'row',
    flexWrap: 'wrap',
  },
  chip: {
    height: 34,
    borderRadius: 17,
    borderWidth: 1,
    borderColor: COLORS.border,
    backgroundColor: COLORS.white,
    alignItems: 'center',
    justifyContent: 'center',
    paddingHorizontal: 8,
    marginBottom: 6,
  },
  chipText: {
    fontSize: 11,
    fontFamily: FONT.bold,
    color: COLORS.ink,
  },
});
