import { Text as ScaledText } from '../../context/ScaledText';
import React, { useState } from 'react';
import { SafeAreaView, ScrollView, StyleSheet, Text, TouchableOpacity, View } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { usePreferences } from '../../context/PreferencesContext';
import { Card, FONT, ScreenHeader, useConfigFonts } from './ConfigUI';

const FAQ = {
  'pt-BR': [
    ['Como faço para marcar uma consulta com um profissional?', 'Acesse a aba Mensagens, toque em “Nova conversa” e escolha uma profissional disponível. Você poderá selecionar entre chat ou dúvida rápida.'],
    ['Como funciona o Diário de Saúde e o meu ciclo?', 'Registre o início do seu ciclo no calendário e adicione sintomas ou humor quando quiser. Com mais registros, o Vênus pode ajudar a acompanhar padrões; as previsões são estimativas.'],
    ['Como faço uma pergunta anônima no fórum?', 'Na aba Fórum, toque em “Fazer uma pergunta” e ative “Perguntar anonimamente”. Seu nome não será exibido na publicação.'],
    ['Como encontro o posto de saúde mais perto de mim?', 'Abra a área de localização e permita o acesso à localização para ver unidades próximas. Você também pode pesquisar manualmente por bairro.'],
    ['Como altero minhas preferências?', 'Entre em Perfil > Configurações para ajustar aparência, idioma, notificações e filtros de interesse. Lembre-se de tocar em Salvar quando a tela oferecer essa opção.'],
  ],
  es: [
    ['¿Cómo puedo solicitar una consulta?', 'Abre Mensajes, toca “Nueva conversación” y elige una profesional disponible.'],
    ['¿Cómo funciona el Diario de Salud?', 'Registra el inicio de tu ciclo y añade síntomas o estado de ánimo cuando quieras. Las predicciones son estimaciones.'],
    ['¿Cómo hago una pregunta anónima?', 'En el Foro, crea una pregunta y activa la opción de publicar anónimamente.'],
    ['¿Cómo encuentro un centro de salud cercano?', 'Abre la ubicación y permite el acceso a tu ubicación, o busca manualmente por barrio.'],
    ['¿Cómo cambio mis preferencias?', 'Ve a Perfil > Configuración para ajustar apariencia, idioma, notificaciones y filtros.'],
  ],
  en: [
    ['How do I book a professional consultation?', 'Open Messages, tap “New conversation” and choose an available professional.'],
    ['How does the Health Journal and cycle tracking work?', 'Record the start of your cycle and add symptoms or mood whenever you want. Predictions are estimates.'],
    ['How do I ask an anonymous forum question?', 'In the Forum, create a question and enable the anonymous posting option.'],
    ['How do I find a nearby health center?', 'Open Location and allow location access, or search manually by neighborhood.'],
    ['How do I change my preferences?', 'Go to Profile > Settings to adjust appearance, language, notifications and interest filters.'],
  ],
};
export default function CentralAjuda() {
  const loaded = useConfigFonts();
  const { colors, preferences } = usePreferences();
  const [expanded, setExpanded] = useState({});
  if (!loaded) return null;
  const lang = preferences.idiomaUsuario || 'pt-BR';
  const title = lang === 'en' ? 'Help center' : lang === 'es' ? 'Centro de ayuda' : 'Central de ajuda';
  const subtitle = lang === 'en' ? 'Find answers to common questions' : lang === 'es' ? 'Encuentra respuestas a preguntas frecuentes' : 'Encontre respostas para as dúvidas mais comuns';
  const faq = FAQ[lang] || FAQ['pt-BR'];
  return <SafeAreaView style={[styles.screen, { backgroundColor: colors.background }]}>
    <ScreenHeader title={title} />
    <ScrollView contentContainerStyle={styles.content} showsVerticalScrollIndicator={false}>
      <ScaledText style={[styles.subtitle, { color: colors.muted }]}>{subtitle}</ScaledText>
      {faq.map(([question, answer], index) => <Card key={question} style={[styles.faqCard, { backgroundColor: index % 2 ? colors.selectedBg : colors.card }]}>
        <TouchableOpacity style={styles.questionRow} onPress={() => setExpanded(prev => ({ ...prev, [index]: !prev[index] }))} accessibilityRole="button" accessibilityState={{ expanded: !!expanded[index] }}>
          <View style={[styles.iconBox, { backgroundColor: colors.iconBg }]}><Ionicons name={['chatbubble-ellipses-outline', 'moon-outline', 'chatbubble-outline', 'location-outline', 'settings-outline'][index]} size={23} color={colors.wine} /></View>
          <ScaledText style={[styles.question, { color: colors.text }]}>{question}</ScaledText>
          <Ionicons name={expanded[index] ? 'chevron-up' : 'chevron-down'} size={16} color={colors.wine} />
        </TouchableOpacity>
        {expanded[index] && <ScaledText style={[styles.answer, { color: colors.text }]}>{answer}</ScaledText>}
      </Card>)}
      <View style={[styles.support, { backgroundColor: colors.wine }]}>
        <Ionicons name="mail-outline" size={22} color="#FFFFFF" />
        <ScaledText style={styles.supportTitle}>{lang === 'en' ? 'Still need help?' : lang === 'es' ? '¿Todavía necesitas ayuda?' : 'Não achou a sua dúvida?'}</ScaledText>
        <ScaledText style={styles.supportText}>{lang === 'en' ? 'Contact our support team for assistance.' : lang === 'es' ? 'Contacta con nuestro equipo de soporte.' : 'Fale com a equipe do Vênus para receber ajuda.'}</ScaledText>
      </View>
    </ScrollView>
  </SafeAreaView>;
}
const styles = StyleSheet.create({ screen: { flex: 1 }, content: { padding: 16, paddingBottom: 34 }, subtitle: { fontFamily: FONT.regular, marginBottom: 16, marginLeft: 4 }, faqCard: { borderRadius: 16, marginBottom: 12, padding: 13, borderWidth: 0 }, questionRow: { flexDirection: 'row', alignItems: 'center', gap: 10 }, iconBox: { width: 42, height: 42, borderRadius: 12, alignItems: 'center', justifyContent: 'center' }, question: { flex: 1, fontFamily: FONT.extrabold }, answer: { fontFamily: FONT.regular, paddingTop: 12, paddingHorizontal: 4 }, support: { borderRadius: 16, padding: 18, alignItems: 'center', marginTop: 6 }, supportTitle: { color: '#FFFFFF', fontFamily: FONT.extrabold, marginTop: 8 }, supportText: { color: '#FFFFFF', fontFamily: FONT.regular, textAlign: 'center', marginTop: 3 }, });
