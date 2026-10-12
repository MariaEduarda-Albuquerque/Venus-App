import { Text as ScaledText, TextInput as ScaledTextInput } from '../../context/ScaledText';
import { useState } from 'react';
import {
  SafeAreaView,
  ScrollView,
  StyleSheet,
  Text,
  TextInput,
  TouchableOpacity,
  View
} from 'react-native';
import { COLORS, FONT, ScreenHeader, Section, useConfigFonts } from './ConfigUI';
import { Alert } from 'react-native';
import api from '../../api/api';
import { useAuth } from '../../context/AuthContext';
import { usePreferences } from '../../context/PreferencesContext';
import { useEffect } from 'react';

function Field({ label, colors, ...inputProps }) {
  return (
    <View style={[styles.field, { backgroundColor: colors.card, borderColor: colors.border }]}>
      <ScaledText style={[styles.fieldLabel, { color: colors.wine }]}>{label}</ScaledText>
      <ScaledTextInput
        style={[styles.fieldInput, { color: colors.text, backgroundColor: colors.input }]}
        placeholderTextColor="#B9A0A8"
        selectionColor={COLORS.wine}
        {...inputProps}
      />
    </View>
  );
}

const TEXTS = {
  'pt-BR': {
    dados: 'Dados pessoais',
    senha: 'Alterar senha',
    email: 'E-mail',
    nascimento: 'Data de nascimento',
    hint: 'Usamos isso só pra te mostrar conteúdo adequado pra sua idade — nunca é exibido publicamente.',
    senhaAtual: 'Senha atual',
    senhaAtualPlaceholder: 'Digite a senha atual',
    novaSenha: 'Nova senha',
    novaSenhaPlaceholder: 'Mínimo de 8 caracteres',
    confirmar: 'Confirmar nova senha',
    confirmarPlaceholder: 'Repita a nova senha',
    esqueci: 'Esqueci minha senha atual',
    salvar: 'Salvar alterações',
    salvando: 'Salvando...',
  },
  es: {
    dados: 'Datos personales',
    senha: 'Cambiar contraseña',
    email: 'Correo electrónico',
    nascimento: 'Fecha de nacimiento',
    hint: 'Lo usamos solo para mostrarte contenido adecuado a tu edad; nunca se muestra públicamente.',
    senhaAtual: 'Contraseña actual',
    senhaAtualPlaceholder: 'Escribe tu contraseña actual',
    novaSenha: 'Nueva contraseña',
    novaSenhaPlaceholder: 'Mínimo 8 caracteres',
    confirmar: 'Confirmar nueva contraseña',
    confirmarPlaceholder: 'Repite la nueva contraseña',
    esqueci: 'Olvidé mi contraseña actual',
    salvar: 'Guardar cambios',
    salvando: 'Guardando...',
  },
  en: {
    dados: 'Personal details',
    senha: 'Change password',
    email: 'Email',
    nascimento: 'Date of birth',
    hint: 'We use this only to show age-appropriate content — it is never shown publicly.',
    senhaAtual: 'Current password',
    senhaAtualPlaceholder: 'Enter your current password',
    novaSenha: 'New password',
    novaSenhaPlaceholder: 'Minimum 8 characters',
    confirmar: 'Confirm new password',
    confirmarPlaceholder: 'Repeat the new password',
    esqueci: 'I forgot my current password',
    salvar: 'Save changes',
    salvando: 'Saving...',
  },
};

export default function DadosPessoais({ navigation, onVoltar }) {
  const fontsLoaded = useConfigFonts();
  const { user, signIn } = useAuth();
  const { colors, preferences } = usePreferences();
  const strings = TEXTS[preferences?.idiomaUsuario || 'pt-BR'] || TEXTS['pt-BR'];

  const [email, setEmail] = useState(user?.emailUsuario || '');
  const [nascimento, setNascimento] = useState(user?.dataNascimentoUsuario || '');
  const [salvando, setSalvando] = useState(false);

  useEffect(() => {
    if (user?.codUsuario || user?.id) {
      api.get(`/usuario/${user.codUsuario ?? user.id}`).then(({ data }) => {
        const u = data.usuario || data;
        setEmail(u.emailUsuario || '');
        setNascimento(u.dataNascimentoUsuario || '');
      }).catch(() => {});
    }
  }, [user?.codUsuario, user?.id]);

  const salvar = async () => {
    const id = user?.codUsuario ?? user?.id;
    if (!id) return Alert.alert('Sessão necessária', 'Entre na sua conta novamente.');
    setSalvando(true);
    try {
      if ((novaSenha || confirmarSenha || senhaAtual) && (!senhaAtual || novaSenha.length < 8 || novaSenha !== confirmarSenha)) {
        Alert.alert('Confira a senha', 'Informe a senha atual, uma nova senha com pelo menos 8 caracteres e confirme-a.');
        return;
      }
      const dataNormalizada = /^\d{4}-\d{2}-\d{2}$/.test(nascimento) ? nascimento : (() => {
        const m = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(nascimento);
        return m ? `${m[3]}-${m[2]}-${m[1]}` : nascimento;
      })();
      const dadosAtualizacao = {
        emailUsuario: email.trim().toLowerCase(),
        dataNascimentoUsuario: dataNormalizada,
      };
      if (novaSenha || confirmarSenha || senhaAtual) {
        dadosAtualizacao.senhaAtual = senhaAtual;
        dadosAtualizacao.senhaUsuario = novaSenha;
      }
      await api.put(`/usuario/${id}/dados-pessoais`, dadosAtualizacao);
      const { data } = await api.get(`/usuario/${id}`);
      const u = data.usuario || data;
      await signIn({ ...user, ...u, id: u.codUsuario, codUsuario: u.codUsuario }, null);
      Alert.alert('Pronto', 'As alterações foram salvas.');
      setSenhaAtual(''); setNovaSenha(''); setConfirmarSenha('');
    } catch (error) { Alert.alert('Erro', error.response?.data?.message || 'Não foi possível salvar as alterações.'); }
    finally { setSalvando(false); }
  };

  const [senhaAtual, setSenhaAtual] = useState('');
  const [novaSenha, setNovaSenha] = useState('');
  const [confirmarSenha, setConfirmarSenha] = useState('');

  if (!fontsLoaded) return null;

  return (
    <SafeAreaView style={[styles.container, { backgroundColor: colors.background }]}>
      <ScreenHeader title="Dados pessoais e senha" onBack={onVoltar || (() => navigation?.goBack())} />

      <ScrollView
        style={styles.scroll}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
        keyboardShouldPersistTaps="handled"
      >
        <Section title={strings.dados} style={styles.dadosSection}>
          <Field
            colors={colors}
            label={strings.email}
            value={email}
            onChangeText={setEmail}
            keyboardType="email-address"
            autoCapitalize="none"
          />
          <Field
            colors={colors}
            label={strings.nascimento}
            value={nascimento}
            onChangeText={setNascimento}
            keyboardType="numbers-and-punctuation"
          />

          <ScaledText style={[styles.hint, { color: colors.muted }]}>
            {strings.hint}
          </ScaledText>
          <View style={styles.divider} />
        </Section>

        <Section title={strings.senha} style={styles.senhaSection}>
          <Field
            colors={colors}
            label={strings.senhaAtual}
            value={senhaAtual}
            onChangeText={setSenhaAtual}
            placeholder={strings.senhaAtualPlaceholder}
            secureTextEntry
          />
          <Field
            colors={colors}
            label={strings.novaSenha}
            value={novaSenha}
            onChangeText={setNovaSenha}
            placeholder={strings.novaSenhaPlaceholder}
            secureTextEntry
          />
          <Field
            colors={colors}
            label={strings.confirmar}
            value={confirmarSenha}
            onChangeText={setConfirmarSenha}
            placeholder={strings.confirmarPlaceholder}
            secureTextEntry
          />

          <TouchableOpacity
            style={styles.forgotButton}
            activeOpacity={0.7}
            onPress={() => navigation?.navigate('EsqueciSenha')}
          >
            <ScaledText style={styles.forgotText}>{strings.esqueci}</ScaledText>
          </TouchableOpacity>
        </Section>

        <TouchableOpacity
          style={styles.saveButton}
          activeOpacity={0.85}
          onPress={salvar}
          disabled={salvando}
          accessibilityRole="button"
          accessibilityLabel={strings.salvar}
        >
          <ScaledText style={styles.saveText}>{salvando ? strings.salvando : strings.salvar}</ScaledText>
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
  dadosSection: {
    marginBottom: 14,
  },
  senhaSection: {
    marginBottom: 6,
  },

  /* Campos */
  field: {
    backgroundColor: COLORS.white,
    borderRadius: 16,
    borderWidth: 1,
    borderColor: COLORS.border,
    paddingHorizontal: 15,
    paddingTop: 9,
    paddingBottom: 8,
    marginBottom: 10,
  },
  fieldLabel: {
    fontSize: 10,
    fontFamily: FONT.extrabold,
    color: COLORS.wine,
  },
  fieldInput: {
    fontSize: 15,
    fontFamily: FONT.regular,
    color: COLORS.ink,
    paddingVertical: 2,
    paddingHorizontal: 0,
    outlineStyle: 'none',
  },
  hint: {
    fontSize: 10,
    lineHeight: 15,
    fontFamily: FONT.regular,
    color: COLORS.muted,
    paddingHorizontal: 15,
    marginTop: 2,
  },
  divider: {
    height: 1,
    backgroundColor: COLORS.border,
    marginTop: 12,
  },

  /* Esqueci a senha / salvar */
  forgotButton: {
    alignSelf: 'flex-start',
    paddingVertical: 2,
  },
  forgotText: {
    fontSize: 11,
    fontFamily: FONT.semibold,
    color: COLORS.wine,
    textDecorationLine: 'underline',
  },
  saveButton: {
    backgroundColor: COLORS.wine,
    borderRadius: 22,
    paddingVertical: 13,
    alignItems: 'center',
    marginTop: 8,
  },
  saveText: {
    fontSize: 14,
    fontFamily: FONT.bold,
    color: COLORS.white,
  },
});
