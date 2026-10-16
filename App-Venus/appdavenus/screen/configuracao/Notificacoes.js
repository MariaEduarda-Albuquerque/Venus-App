import { useState, useEffect } from 'react';
import { Alert } from 'react-native';
import { usePreferences } from '../../context/PreferencesContext';
import { SafeAreaView, ScrollView, StyleSheet } from 'react-native';
import {
  Card,
  COLORS,
  ScreenHeader,
  Section,
  ToggleRow,
  useConfigFonts,
} from './ConfigUI';

const TEXTS = {
  'pt-BR': {
    atendimento: 'Atendimento',
    comunidade: 'Comunidade',
    saude: 'Saúde',
    especialistas: 'Mensagens de especialistas',
    consulta: 'Lembrete de consulta agendada',
    diarioAtendimento: 'Lembretes do diário de saúde',
    respostas: 'Respostas às minhas publicações',
    atividade: 'Atividade na comunidade',
    diarioSaude: 'Lembretes do Diário de Saúde',
    campanhas: 'Campanhas e conteúdos novos',
  },
  es: {
    atendimento: 'Atención',
    comunidade: 'Comunidad',
    saude: 'Salud',
    especialistas: 'Mensajes de especialistas',
    consulta: 'Recordatorio de consulta programada',
    diarioAtendimento: 'Recordatorios del diario de salud',
    respostas: 'Respuestas a mis publicaciones',
    atividade: 'Actividad en la comunidad',
    diarioSaude: 'Recordatorios del Diario de Salud',
    campanhas: 'Campañas y contenido nuevo',
  },
  en: {
    atendimento: 'Care',
    comunidade: 'Community',
    saude: 'Health',
    especialistas: 'Messages from specialists',
    consulta: 'Scheduled appointment reminder',
    diarioAtendimento: 'Health journal reminders',
    respostas: 'Replies to my posts',
    atividade: 'Community activity',
    diarioSaude: 'Health Journal reminders',
    campanhas: 'Campaigns and new content',
  },
};

export default function Notificacoes({ onVoltar }) {
  const fontsLoaded = useConfigFonts();
  const { preferences, updatePreferences, colors } = usePreferences();
  const strings = TEXTS[preferences.idiomaUsuario || 'pt-BR'] || TEXTS['pt-BR'];
  const [valores, setValores] = useState(preferences.preferenciasNotificacaoUsuario || {});
  useEffect(() => setValores(preferences.preferenciasNotificacaoUsuario || {}), [preferences.preferenciasNotificacaoUsuario]);
  async function alterar(chave, valor) {
    const novos = { ...valores, [chave]: valor };
    setValores(novos);
    try { await updatePreferences({ preferenciasNotificacaoUsuario: novos }); }
    catch (error) { Alert.alert('Erro ao salvar', error.response?.data?.message || 'Não foi possível salvar esta preferência.'); }
  }

  if (!fontsLoaded) return null;

  return (
    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>
      <ScreenHeader title="Notificações" onBack={onVoltar} />

      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
      >
        <Section title={strings.atendimento}>
          <Card>
            <ToggleRow
              isFirst
              label={strings.especialistas}
              value={!!valores.especialistas}
              onValueChange={(v) => alterar('especialistas', v)}
            />
            <ToggleRow
              label={strings.consulta}
              subtitle="1 dia e 1 hora antes"
              value={!!valores.consulta}
              onValueChange={(v) => alterar('consulta', v)}
            />
            <ToggleRow
              label={strings.diarioAtendimento}
              value={!!valores.diarioAtendimento}
              onValueChange={(v) => alterar('diarioAtendimento', v)}
            />
          </Card>
        </Section>

        <Section title={strings.comunidade}>
          <Card>
            <ToggleRow
              isFirst
              label={strings.respostas}
              value={!!valores.respostas}
              onValueChange={(v) => alterar('respostas', v)}
            />
            <ToggleRow
              label={strings.atividade}
              value={!!valores.atividade}
              onValueChange={(v) => alterar('atividade', v)}
            />
          </Card>
        </Section>

        <Section title={strings.saude}>
          <Card>
            <ToggleRow
              isFirst
              label={strings.diarioSaude}
              value={!!valores.diarioSaude}
              onValueChange={(v) => alterar('diarioSaude', v)}
            />
            <ToggleRow
              label={strings.campanhas}
              value={!!valores.campanhas}
              onValueChange={(v) => alterar('campanhas', v)}
            />
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
});
