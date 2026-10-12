import { Text as ScaledText, TextInput as ScaledTextInput } from '../../context/ScaledText';
import React, { useEffect, useState } from "react";

import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Alert,
  ScrollView,
  StyleSheet,
} from "react-native";

import api from "../../api/api";
import { useAuth } from "../../context/AuthContext";
import { usePreferences } from "../../context/PreferencesContext";
import { Ionicons } from "@expo/vector-icons";
import { Colors, Spacing, commonStyles } from "../themes/theme";
import FundoOndas from "../themes/FundoOndas";
import SeletorFoto from "../themes/SeletorFoto";
import { useModalConfirmacao } from "../themes/ModalConfirmacao";
import { formatarCpf, validarCpf, apenasDigitos } from "../utils/cpf";
import { enviarFotoPerfil, urlFoto } from "../utils/fotoPerfil";

const EDIT_PROFILE_TEXTS = {
  'pt-BR': {
    loading: 'Carregando...',
    sessionRequired: 'Sessão necessária',
    sessionRequiredMessage: 'Entre na sua conta novamente.',
    invalidCpf: 'CPF inválido',
    invalidCpfMessage: 'Confira o CPF digitado e tente novamente.',
    loadErrorTitle: 'Erro',
    loadErrorMessage: 'Não foi possível carregar os dados.',
    saveFail: 'Não foi possível alterar o perfil.',
    title: 'Editar perfil',
    subtitle: 'Atualize suas informações',
    name: 'Nome',
    nickname: 'Apelido',
    email: 'E-mail',
    cpf: 'CPF',
    birthDate: 'Data de nascimento',
    city: 'Cidade',
    uf: 'UF',
    save: 'Salvar alterações',
    saving: 'Salvando...',
    logout: 'Deslogar',
    logoutConfirm: 'Tem certeza que deseja sair da sua conta?',
    confirm: 'Confirmar',
    cancel: 'Cancelar',
    deleteAccount: 'Excluir conta',
    deleteAccountConfirm: 'Essa ação é permanente e não pode ser desfeita. Todos os seus dados serão apagados. Deseja continuar?',
    deleting: 'Excluindo...',
    deleted: 'Conta excluída',
    deletedSuccess: 'Sua conta foi excluída com sucesso.',
    photoError: ' Não foi possível enviar a nova foto; tente novamente.',
    updated: 'Perfil atualizado!',
    updatedSuccess: 'Suas informações foram alteradas com sucesso.',
    ok: 'OK',
  },
  es: {
    loading: 'Cargando...',
    sessionRequired: 'Sesión necesaria',
    sessionRequiredMessage: 'Inicia sesión nuevamente.',
    invalidCpf: 'CPF inválido',
    invalidCpfMessage: 'Revisa el CPF ingresado y vuelve a intentarlo.',
    loadErrorTitle: 'Error',
    loadErrorMessage: 'No se pudieron cargar los datos.',
    saveFail: 'No se pudo cambiar el perfil.',
    title: 'Editar perfil',
    subtitle: 'Actualiza tu información',
    name: 'Nombre',
    nickname: 'Apodo',
    email: 'Correo',
    cpf: 'CPF',
    birthDate: 'Fecha de nacimiento',
    city: 'Ciudad',
    uf: 'UF',
    save: 'Guardar cambios',
    saving: 'Guardando...',
    logout: 'Cerrar sesión',
    logoutConfirm: '¿Seguro que quieres salir de tu cuenta?',
    confirm: 'Confirmar',
    cancel: 'Cancelar',
    deleteAccount: 'Eliminar cuenta',
    deleteAccountConfirm: 'Esta acción es permanente y no se puede deshacer. Todos tus datos se eliminarán. ¿Deseas continuar?',
    deleting: 'Eliminando...',
    deleted: 'Cuenta eliminada',
    deletedSuccess: 'Tu cuenta fue eliminada con éxito.',
    photoError: ' No se pudo enviar la nueva foto; inténtalo de nuevo.',
    updated: 'Perfil actualizado',
    updatedSuccess: 'Tu información fue actualizada con éxito.',
    ok: 'OK',
  },
  en: {
    loading: 'Loading...',
    sessionRequired: 'Session required',
    sessionRequiredMessage: 'Please sign in again.',
    invalidCpf: 'Invalid CPF',
    invalidCpfMessage: 'Please check the CPF and try again.',
    loadErrorTitle: 'Error',
    loadErrorMessage: 'Could not load your data.',
    saveFail: 'Could not update your profile.',
    title: 'Edit profile',
    subtitle: 'Update your information',
    name: 'Name',
    nickname: 'Nickname',
    email: 'Email',
    cpf: 'CPF',
    birthDate: 'Date of birth',
    city: 'City',
    uf: 'State',
    save: 'Save changes',
    saving: 'Saving...',
    logout: 'Log out',
    logoutConfirm: 'Are you sure you want to sign out?',
    confirm: 'Confirm',
    cancel: 'Cancel',
    deleteAccount: 'Delete account',
    deleteAccountConfirm: 'This action is permanent and cannot be undone. All your data will be deleted. Do you want to continue?',
    deleting: 'Deleting...',
    deleted: 'Account deleted',
    deletedSuccess: 'Your account was deleted successfully.',
    photoError: ' The new photo could not be uploaded; please try again.',
    updated: 'Profile updated!',
    updatedSuccess: 'Your information was updated successfully.',
    ok: 'OK',
  },
};

export default function EditarPerfil({ route, navigation }) {

  const { user, signIn, signOut } = useAuth();
  const { colors, preferences } = usePreferences();
  const idioma = preferences.idiomaUsuario || 'pt-BR';
  const strings = EDIT_PROFILE_TEXTS[idioma] || EDIT_PROFILE_TEXTS['pt-BR'];
  const id = route?.params?.id ?? user?.codUsuario ?? user?.id;

  const { modal, mostrarModal } = useModalConfirmacao();

  const [nome, setNome] = useState("");
  const [apelido, setApelido] = useState("");
  const [email, setEmail] = useState("");
  const [cpf, setCpf] = useState("");

  // fotoAtual: foto que já está salva; novaFotoUri: foto escolhida agora (ainda não enviada).
  const [fotoAtual, setFotoAtual] = useState(null);
  const [novaFotoUri, setNovaFotoUri] = useState(null);

  // CORREÇÃO DE BUG: no código original, a função salvarPerfil() usava as
  // variáveis "dataNascimento", "cidade" e "uf" para montar o corpo da
  // requisição, mas elas nunca tinham sido criadas com useState — isso ia
  // gerar um erro (ReferenceError) assim que o usuário tentasse salvar.
  // Criei os estados abaixo e os respectivos campos no formulário, já que
  // a tela de Perfil.js também exibe esses dados.
  const [dataNascimento, setDataNascimento] = useState("");
  const [cidade, setCidade] = useState("");
  const [uf, setUf] = useState("");

  const [loading, setLoading] = useState(true);
  const [salvando, setSalvando] = useState(false);

  // NOVO: estado usado enquanto a exclusão da conta está sendo processada,
  // pra desabilitar os botões e mostrar "Excluindo..." no lugar do texto.
  const [excluindo, setExcluindo] = useState(false);

  const carregarUsuario = async () => {
    if (!id) {
      setLoading(false);
      Alert.alert(strings.sessionRequired, strings.sessionRequiredMessage);
      return;
    }

    try {

      const response = await api.get(
        `/usuario/${id}`
      );

      const usuario = response.data?.usuario || response.data;

      setNome(usuario.nomeUsuario || "");
      setApelido(usuario.apelidoUsuario || "");
      setEmail(usuario.emailUsuario || "");
      setCpf(formatarCpf(usuario.cpfUsuario || ""));
      setFotoAtual(urlFoto(usuario.fotoPerfilUsuario));
      setDataNascimento(usuario.dataNascimentoUsuario || "");
      setCidade(usuario.cidadeUsuario || "");
      setUf(usuario.ufUsuario || "");

    } catch (error) {

      console.log(
        "ERRO:",
        error.response?.data
      );

      Alert.alert(
        strings.loadErrorTitle,
        strings.loadErrorMessage
      );

    } finally {

      setLoading(false);

    }
  };

  useEffect(() => {

    carregarUsuario();

  }, []);

  const salvarPerfil = async () => {

    if (!id) {
      Alert.alert(strings.sessionRequired, strings.sessionRequiredMessage);
      return;
    }
    if (!validarCpf(cpf)) {
      Alert.alert(strings.invalidCpf, strings.invalidCpfMessage);
      return;
    }
    const dataISO = /^\d{4}-\d{2}-\d{2}$/.test(dataNascimento)
      ? dataNascimento
      : (() => {
          const m = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(dataNascimento);
          return m ? `${m[3]}-${m[2]}-${m[1]}` : dataNascimento;
        })();

    setSalvando(true);

    try {

      const response = await api.put(
        `/usuario/${id}`,
        {
          nomeUsuario: nome,
          apelidoUsuario: apelido || null,
          emailUsuario: email.trim().toLowerCase(),
          cpfUsuario: apenasDigitos(cpf),
          dataNascimentoUsuario: dataISO,
          cidadeUsuario: cidade || null,
          ufUsuario: uf || null
        }
      );

      const usuarioAtualizado = response.data.usuario || response.data;
      await signIn({
        ...user,
        ...usuarioAtualizado,
        id: usuarioAtualizado.codUsuario ?? id,
        codUsuario: usuarioAtualizado.codUsuario ?? id,
        nome: usuarioAtualizado.nomeUsuario ?? nome,
      }, null);

      // A foto só é enviada se a usuária escolheu uma nova. Se o envio falhar,
      // os dados do perfil já foram salvos e o modal avisa sobre a foto.
      let avisoFoto = "";

      if (novaFotoUri) {
        try {
          const fotoSalva = await enviarFotoPerfil(id, novaFotoUri);
          if (fotoSalva) {
            const fotoPublica = urlFoto(fotoSalva);
            setFotoAtual(fotoPublica);
            setNovaFotoUri(null);
            await signIn({ ...user, ...usuarioAtualizado, fotoPerfilUsuario: fotoSalva, id, codUsuario: id }, null);
          }
        } catch (erroFoto) {
          avisoFoto = strings.photoError;
        }
      }

      mostrarModal({
        tipo: "sucesso",
        titulo: strings.updated,
        mensagem: strings.updatedSuccess + avisoFoto,
        textoConfirmar: strings.ok,
        onConfirmar: () => navigation.goBack(),
      });

    } catch (error) {

      if (error.response?.data?.errors) {

        const erros =
          error.response.data.errors;

        const primeiraMensagem =
          Object.values(erros)[0][0];

        Alert.alert(
          strings.loadErrorTitle,
          primeiraMensagem
        );

      } else {

        Alert.alert(
          strings.loadErrorTitle,
          error.response?.data?.message || strings.saveFail
        );

      }

    } finally {

      setSalvando(false);

    }
  };

  // Encerra a sessão local e remove o token persistido.
  const deslogar = () => {

    mostrarModal({
      tipo: "confirmar",
      titulo: strings.logout,
      mensagem: strings.logoutConfirm,
      textoConfirmar: strings.logout,
      textoCancelar: strings.cancel,
      onConfirmar: async () => {
        try { await api.post("/logout"); } catch (e) {}
        await signOut();
        navigation.reset({ index: 0, routes: [{ name: "Login" }] });
      },
    });

  };

  // NOVO: "Excluir conta".
  // Pede confirmação (ação destrutiva e irreversível) antes de chamar a API.
  // A rota abaixo (DELETE /usuario/:id) segue o mesmo padrão REST que já
  // existe nas outras telas (GET e PUT em /usuario/:id) — se ela ainda não
  // existir no back-end Laravel, é só criar o método "destroy" no
  // UsuarioController e a rota correspondente.
  const excluirConta = () => {

    mostrarModal({
      tipo: "perigo",
      titulo: strings.deleteAccount,
      mensagem: strings.deleteAccountConfirm,
      textoConfirmar: strings.deleteAccount,
      textoCancelar: strings.cancel,
      onConfirmar: confirmarExclusao,
    });

  };

  const confirmarExclusao = async () => {

    setExcluindo(true);

    try {

      await api.delete(`/usuario/${id}`);

      mostrarModal({
        tipo: "sucesso",
        titulo: strings.deleted,
        mensagem: strings.deletedSuccess,
        textoConfirmar: strings.ok,
        onConfirmar: async () => {
          await signOut();
          navigation.reset({ index: 0, routes: [{ name: "Login" }] });
        },
      });

    } catch (error) {

      console.log(
        "ERRO AO EXCLUIR CONTA:",
        error.response?.data
      );

      Alert.alert(
        strings.loadErrorTitle,
        error.response?.data?.message || strings.saveFail
      );

    } finally {

      setExcluindo(false);

    }
  };

  if (loading) {

    return (
      <View style={commonStyles.centered}>
        <ScaledText style={commonStyles.title}>
          {strings.loading}
        </ScaledText>
      </View>
    );

  }

  return (

    <View style={[commonStyles.screen, { backgroundColor: colors.background }]}> 
      <FundoOndas />
      <ScrollView style={styles.scroll} contentContainerStyle={commonStyles.scrollContent}>

      <View style={[commonStyles.card, { backgroundColor: colors.card, borderWidth: 1, borderColor: colors.border }] }>

        <ScaledText style={[commonStyles.title, { color: colors.text }]}>{strings.title}</ScaledText>
        <ScaledText style={[commonStyles.subtitle, { color: colors.muted }]}>{strings.subtitle}</ScaledText>

        <SeletorFoto
          uri={novaFotoUri || fotoAtual}
          onChange={setNovaFotoUri}
          desabilitado={salvando || excluindo}
        />

        <ScaledText style={[commonStyles.label, { color: colors.text }]}>{strings.name}</ScaledText>
        <View style={[commonStyles.inputWrapper, { backgroundColor: colors.input, borderColor: colors.border }] }>
          <Ionicons name="person-outline" size={20} color={colors.wine} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={[commonStyles.input, { color: colors.text }]}
            value={nome}
            onChangeText={setNome}
          />
        </View>

        <ScaledText style={[commonStyles.label, { color: colors.text }]}>{strings.nickname}</ScaledText>
        <View style={[commonStyles.inputWrapper, { backgroundColor: colors.input, borderColor: colors.border }] }>
          <Ionicons name="happy-outline" size={20} color={colors.wine} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={[commonStyles.input, { color: colors.text }]}
            value={apelido}
            onChangeText={setApelido}
          />
        </View>

        <ScaledText style={[commonStyles.label, { color: colors.text }]}>{strings.email}</ScaledText>
        <View style={[commonStyles.inputWrapper, { backgroundColor: colors.input, borderColor: colors.border }] }>
          <Ionicons name="mail-outline" size={20} color={colors.wine} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={[commonStyles.input, { color: colors.text }]}
            value={email}
            onChangeText={setEmail}
            keyboardType="email-address"
            autoCapitalize="none"
          />
        </View>

        <ScaledText style={[commonStyles.label, { color: colors.text }]}>{strings.cpf}</ScaledText>
        <View style={[commonStyles.inputWrapper, { backgroundColor: colors.input, borderColor: colors.border }] }>
          <Ionicons name="card-outline" size={20} color={colors.wine} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={[commonStyles.input, { color: colors.text }]}
            placeholder="000.000.000-00"
            placeholderTextColor={colors.muted}
            value={cpf}
            onChangeText={(texto) => setCpf(formatarCpf(texto))}
            keyboardType="numeric"
            maxLength={14}
          />
        </View>

        <ScaledText style={[commonStyles.label, { color: colors.text }]}>{strings.birthDate}</ScaledText>
        <View style={[commonStyles.inputWrapper, { backgroundColor: colors.input, borderColor: colors.border }] }>
          <Ionicons name="calendar-outline" size={20} color={colors.wine} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={[commonStyles.input, { color: colors.text }]}
            placeholder="AAAA-MM-DD"
            placeholderTextColor={colors.muted}
            value={dataNascimento}
            onChangeText={setDataNascimento}
          />
        </View>

        <View style={styles.linha}>
          <View style={styles.colunaCidade}>
            <ScaledText style={[commonStyles.label, { color: colors.text }]}>{strings.city}</ScaledText>
            <View style={[commonStyles.inputWrapper, { backgroundColor: colors.input, borderColor: colors.border }] }>
              <Ionicons name="location-outline" size={20} color={colors.wine} style={commonStyles.inputIconStyle} />
              <ScaledTextInput
                style={[commonStyles.input, { color: colors.text }]}
                value={cidade}
                onChangeText={setCidade}
              />
            </View>
          </View>

          <View style={styles.colunaUf}>
            <ScaledText style={[commonStyles.label, { color: colors.text }]}>{strings.uf}</ScaledText>
            <View style={[commonStyles.inputWrapper, { backgroundColor: colors.input, borderColor: colors.border }] }>
              <ScaledTextInput
                style={[commonStyles.input, { color: colors.text }]}
                value={uf}
                onChangeText={setUf}
                autoCapitalize="characters"
                maxLength={2}
              />
            </View>
          </View>
        </View>

        <TouchableOpacity
          style={[commonStyles.button, salvando && commonStyles.buttonDisabled]}
          onPress={salvarPerfil}
          disabled={salvando}
        >
          <ScaledText style={commonStyles.buttonText}>
            {salvando
              ? strings.saving
              : strings.save}
          </ScaledText>
        </TouchableOpacity>

        <TouchableOpacity
          style={[styles.logoutButton, { backgroundColor: colors.wine }, (salvando || excluindo) && commonStyles.buttonDisabled]}
          onPress={deslogar}
          disabled={salvando || excluindo}
          accessibilityRole="button"
          accessibilityLabel={strings.logout}
        >
          <Ionicons name="log-out-outline" size={18} color={colors.white} />
          <ScaledText style={commonStyles.buttonText}>{strings.logout}</ScaledText>
        </TouchableOpacity>

        <TouchableOpacity
          style={[commonStyles.buttonDanger, excluindo && commonStyles.buttonDisabled]}
          onPress={excluirConta}
          disabled={excluindo}
        >
          <ScaledText style={commonStyles.buttonText}>
            {excluindo ? strings.deleting : strings.deleteAccount}
          </ScaledText>
        </TouchableOpacity>

      </View>

      </ScrollView>
      {modal}
    </View>

  );
}

const styles = StyleSheet.create({
  logoutButton: {
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "center",
    gap: 10,
    borderRadius: 14,
    paddingVertical: 15,
    paddingHorizontal: 20,
    marginTop: 14,
    elevation: 2,
  },
  scroll: {
    flex: 1,
  },
  linha: {
    flexDirection: "row",
    justifyContent: "space-between",
  },
  colunaCidade: {
    flex: 2,
    marginRight: Spacing.sm,
  },
  colunaUf: {
    flex: 1,
  },
});
