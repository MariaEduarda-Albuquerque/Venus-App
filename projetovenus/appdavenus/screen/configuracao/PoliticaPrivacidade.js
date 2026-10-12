import { Text as ScaledText } from '../../context/ScaledText';
import React from 'react';
import { SafeAreaView, ScrollView, StyleSheet, Text, View } from 'react-native';
import { usePreferences } from '../../context/PreferencesContext';
import { Card, FONT, ScreenHeader, useConfigFonts } from './ConfigUI';

const SECTIONS = {
  'pt-BR': [
    ['1. Quem somos', 'O Vênus é um aplicativo de saúde feminina criado para levar informação confiável, acolhedora e acessível sobre saúde sexual e reprodutiva a adolescentes e mulheres jovens. Esta política explica quais dados tratamos e quais são seus direitos.'],
    ['2. Quais dados coletamos', 'Dados de cadastro: nome ou apelido, e-mail, data de nascimento e informações que você decidir adicionar ao perfil. Dados de saúde: registros do Diário de Saúde, sintomas, humor, ciclo menstrual, perguntas e conteúdos que você decidir compartilhar. Dados técnicos: informações básicas do dispositivo e registros de erros para melhorar a experiência.'],
    ['3. Como usamos seus dados', 'Usamos as informações para personalizar o conteúdo, conectar você a recursos e profissionais relevantes, permitir o funcionamento do Diário de Saúde, responder dúvidas, melhorar o aplicativo e cumprir obrigações legais. Não vendemos seus dados a terceiros.'],
    ['4. Anonimato e sigilo', 'Você pode enviar perguntas ao fórum de forma anônima. Conversas com profissionais de saúde são protegidas por sigilo, conforme as regras aplicáveis. Avaliações públicas não devem expor informações pessoais ou de saúde.'],
    ['5. Com quem compartilhamos seus dados', 'Os dados podem ser compartilhados com profissionais cadastrados quando você inicia atendimento, com prestadores técnicos necessários para manter o aplicativo funcionando e quando houver obrigação legal. Fora dessas situações, não compartilhamos seus dados pessoais.'],
    ['6. Proteção de dados de adolescentes', 'Coletamos apenas os dados necessários para oferecer o serviço. Respeitamos os direitos previstos no Estatuto da Criança e do Adolescente e na legislação de proteção de dados. Quando identificamos risco grave à vida ou à saúde, podemos priorizar a segurança conforme a lei.'],
    ['7. Segurança das informações', 'Adotamos medidas técnicas e organizacionais para proteger suas informações, incluindo comunicações criptografadas quando disponíveis e controles de acesso. Nenhum sistema é totalmente imune a falhas; caso ocorra um incidente relevante, adotaremos as medidas cabíveis.'],
    ['8. Seus direitos', 'De acordo com a LGPD, você pode confirmar o tratamento, acessar, corrigir e solicitar a exclusão de dados, pedir portabilidade quando aplicável, revogar consentimentos e saber com quem compartilhamos suas informações. Para exercer seus direitos, entre em contato pelo canal de suporte do aplicativo.'],
  ],
  es: [
    ['1. Quiénes somos', 'Vênus es una aplicación de salud femenina que ofrece información confiable y accesible. Esta política explica qué datos tratamos y cuáles son tus derechos.'],
    ['2. Qué datos recopilamos', 'Datos de registro, información que agregues al perfil, registros de salud que decidas guardar y datos técnicos básicos necesarios para mejorar la aplicación.'],
    ['3. Cómo usamos tus datos', 'Usamos la información para personalizar contenidos, permitir el Diario de Salud, responder preguntas, mejorar la aplicación y cumplir obligaciones legales. No vendemos tus datos.'],
    ['4. Anonimato y confidencialidad', 'Puedes enviar preguntas al foro de forma anónima. Las conversaciones con profesionales están sujetas a las reglas de confidencialidad aplicables.'],
    ['5. Con quién compartimos datos', 'Solo con profesionales cuando solicitas atención, proveedores técnicos necesarios o cuando la ley lo exige.'],
    ['6. Protección de adolescentes', 'Recopilamos solo los datos necesarios y respetamos la legislación de protección de menores y datos personales.'],
    ['7. Seguridad', 'Aplicamos medidas técnicas y organizativas para proteger la información. Ningún sistema está completamente libre de riesgos.'],
    ['8. Tus derechos', 'Puedes solicitar acceso, corrección, eliminación y portabilidad cuando corresponda, así como revocar consentimientos. Contacta con el soporte de la aplicación.'],
  ],
  en: [
    ['1. Who we are', 'Vênus is a women’s health app offering reliable, supportive and accessible information. This policy explains what data we process and your rights.'],
    ['2. Data we collect', 'Registration details, information you add to your profile, health journal entries you choose to save, and basic technical data needed to improve the app.'],
    ['3. How we use data', 'We use information to personalize content, operate the Health Journal, answer questions, improve the app and meet legal obligations. We do not sell your data.'],
    ['4. Anonymity and confidentiality', 'You can submit forum questions anonymously. Conversations with health professionals are protected by applicable confidentiality rules.'],
    ['5. Data sharing', 'Data may be shared with professionals when you request care, technical providers needed to run the app, or when legally required.'],
    ['6. Teen privacy', 'We collect only data needed to provide the service and respect applicable child and data protection laws.'],
    ['7. Security', 'We use technical and organizational safeguards to protect information. No system is completely risk-free.'],
    ['8. Your rights', 'You may request access, correction, deletion and portability where applicable, and withdraw consent. Contact in-app support to exercise your rights.'],
  ],
};

export default function PoliticaPrivacidade() {
  const loaded = useConfigFonts();
  const { colors, preferences } = usePreferences();
  if (!loaded) return null;
  const sections = SECTIONS[preferences.idiomaUsuario] || SECTIONS['pt-BR'];
  const title = preferences.idiomaUsuario === 'en' ? 'Privacy policy' : preferences.idiomaUsuario === 'es' ? 'Política de privacidad' : 'Política de privacidade';
  return <SafeAreaView style={[styles.screen, { backgroundColor: colors.background }]}>
    <ScreenHeader title={title} />
    <ScrollView contentContainerStyle={styles.content} showsVerticalScrollIndicator={false}>
      <Card style={styles.card}>
        <ScaledText style={[styles.heading, { color: colors.wine }] }>{title}</ScaledText>
        <ScaledText style={[styles.updated, { color: colors.muted }]}>Última atualização: 08/09/2026</ScaledText>
        {sections.map(([heading, body]) => <View key={heading} style={styles.section}>
          <ScaledText style={[styles.sectionTitle, { color: colors.wine }]}>{heading}</ScaledText>
          <ScaledText style={[styles.body, { color: colors.text }]}>{body}</ScaledText>
        </View>)}
        <ScaledText style={[styles.footer, { color: colors.muted }]}>Esta política foi escrita para ser acessível e transparente. Cuidar da sua saúde começa por respeitar sua privacidade.</ScaledText>
      </Card>
    </ScrollView>
  </SafeAreaView>;
}
const styles = StyleSheet.create({ screen: { flex: 1 }, content: { paddingHorizontal: 16, paddingTop: 14, paddingBottom: 32 }, card: { borderRadius: 22, padding: 20 }, heading: { fontFamily: FONT.extrabold, textAlign: 'center', marginBottom: 10 }, updated: { fontFamily: FONT.regular, marginBottom: 16 }, section: { marginBottom: 16 }, sectionTitle: { fontFamily: FONT.extrabold, marginBottom: 4 }, body: { fontFamily: FONT.regular }, footer: { fontFamily: FONT.regular, textAlign: 'center', marginTop: 8 }, });
