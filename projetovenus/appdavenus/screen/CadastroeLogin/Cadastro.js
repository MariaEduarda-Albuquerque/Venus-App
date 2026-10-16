import { Text as ScaledText, TextInput as ScaledTextInput } from '../../context/ScaledText';
import React, { useState } from "react";
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
import { Ionicons } from "@expo/vector-icons";
import { CommonActions } from "@react-navigation/native";
import { Colors, Spacing, commonStyles } from "../themes/theme";
import FundoOndas from "../themes/FundoOndas";
import { useAuth } from "../../context/AuthContext";
import DateTimePickerModal from 'react-native-modal-datetime-picker';
import SeletorFoto from "../themes/SeletorFoto";
import { useModalConfirmacao } from "../themes/ModalConfirmacao";
import { formatarCpf, validarCpf, apenasDigitos } from "../utils/cpf";
import { enviarFotoPerfil } from "../utils/fotoPerfil";


export default function Cadastro({ navigation }) {

  const { signIn } = useAuth();
  const { modal, mostrarModal } = useModalConfirmacao();

  const [fotoUri, setFotoUri] = useState(null);
  const [nome, setNome] = useState("");
  const [email, setEmail] = useState("");
  const [cpf, setCpf] = useState("");
  const [senha, setSenha] = useState("");
  const [dataNascimento, setDataNascimento] = useState('');
  const [confirmarSenha, setConfirmarSenha] = useState("");

  const [loading, setLoading] = useState(false);
  const handleDataChange = (text) => {
  const apenasNumeros = text.replace(/\D/g, '');
  let dataFormatada = apenasNumeros;
  if (apenasNumeros.length > 2 && apenasNumeros.length <= 4) {
    dataFormatada = `${apenasNumeros.slice(0, 2)}/${apenasNumeros.slice(2)}`;
  } else if (apenasNumeros.length > 4) {
    dataFormatada = `${apenasNumeros.slice(0, 2)}/${apenasNumeros.slice(2, 4)}/${apenasNumeros.slice(4, 8)}`;
  }

  setDataNascimento(dataFormatada);
};
  const [mostrarSenha, setMostrarSenha] = useState(false);
  const [mostrarConfirmarSenha, setMostrarConfirmarSenha] = useState(false);

  const [aceitouTermos, setAceitouTermos] = useState(false);

  const cadastrar = async () => {

    if (!nome.trim() || !email.trim() || !cpf.trim() || !senha || !confirmarSenha || !dataNascimento) {
      Alert.alert(
        "Atenção",
        "Preencha todos os campos obrigatórios."
      );
      return;
    }

    if (!validarCpf(cpf)) {
      Alert.alert("CPF inválido", "Confira o CPF digitado e tente novamente.");
      return;
    }

    if (senha.length < 8) {
      Alert.alert("Senha inválida", "A senha deve ter pelo menos 8 caracteres.");
      return;
    }

    if (senha !== confirmarSenha) {
      Alert.alert(
        "Erro",
        "As senhas não coincidem."
      );
      return;
    }

    if (!aceitouTermos) {
      Alert.alert(
        "Atenção",
        "Você precisa aceitar os Termos de Uso e a Política de Privacidade para continuar."
      );
      return;
    }

    setLoading(true);

    try {

      const partesData = dataNascimento.split('/');
      if (partesData.length !== 3 || partesData[2].length !== 4) {
        Alert.alert("Data inválida", "Digite a data no formato DD/MM/AAAA.");
        return;
      }
      const dataISO = `${partesData[2]}-${partesData[1].padStart(2, '0')}-${partesData[0].padStart(2, '0')}`;

      const response = await api.post(`/cadastro`, {
        nomeUsuario: nome.trim(),
        emailUsuario: email.trim().toLowerCase(),
        senhaUsuario: senha,
        cpfUsuario: apenasDigitos(cpf),
        dataNascimentoUsuario: dataISO,
      });

      const usuario = response.data.usuario;

      
      const fotoSelecionada = fotoUri;
      setNome("");
      setEmail("");
      setCpf("");
      setSenha("");
      setConfirmarSenha("");
      setDataNascimento("");
      setFotoUri(null);
      setAceitouTermos(false);

      // O login (signIn) e a ida para a Home acontecem ao tocar em "Continuar" no modal,
      // para o modal não sumir caso o navegador troque de tela assim que a sessão é criada.
      mostrarModal({
        tipo: "sucesso",
        titulo: "Cadastro realizado!",
        mensagem: "Seja bem-vinda ao Vênus.",
        textoConfirmar: "Continuar",
        onConfirmar: async () => {

          await signIn({
            ...usuario,
            id: usuario?.codUsuario,
            codUsuario: usuario?.codUsuario,
            nome: usuario?.nomeUsuario || nome,
          }, response.data.token);

          if (fotoSelecionada && usuario?.codUsuario) {
            try {
              const fotoSalva = await enviarFotoPerfil(usuario.codUsuario, fotoSelecionada);
              if (fotoSalva) {
                await signIn({ ...usuario, id: usuario.codUsuario, codUsuario: usuario.codUsuario, fotoPerfilUsuario: fotoSalva }, response.data.token);
              }
            } catch (erroFoto) {
              Alert.alert("Foto não enviada", "Sua conta foi criada, mas não foi possível salvar a foto. Você pode tentar novamente em Editar perfil.");
            }
          }

          navigation.dispatch(
            CommonActions.reset({
              index: 0,
              routes: [{ name: "Home" }],
            })
          );

        },
      });

    } catch (error) {

      if (error.response?.data?.errors) {

        const erros = error.response.data.errors;

        const primeiraMensagem =
          erros.cpfUsuario?.[0] ||
          erros.emailUsuario?.[0] ||
          Object.values(erros)[0][0];

        Alert.alert(
          "Erro no cadastro",
          primeiraMensagem
        );

      } else {

        Alert.alert(
          "Erro",
          error.response?.data?.message ||
          "Não foi possível realizar o cadastro."
        );

      }

    } finally {

      setLoading(false);

    }
  };

  return (
    <View style={commonStyles.screen}>
      <FundoOndas variant="cadastro" />
      <ScrollView style={styles.scroll} contentContainerStyle={commonStyles.scrollContent}>

      <View style={commonStyles.card}>

        <ScaledText style={commonStyles.title}>Inicie sua jornada!</ScaledText>
        <ScaledText style={commonStyles.subtitle}>O próximo passo para sua saúde</ScaledText>

        <SeletorFoto uri={fotoUri} onChange={setFotoUri} desabilitado={loading} />

        <ScaledText style={commonStyles.label}>Nome</ScaledText>
        <View style={commonStyles.inputWrapper}>
          <Ionicons name="person-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={commonStyles.input}
            placeholder="Maria Eduarda"
            placeholderTextColor={Colors.placeholder}
            value={nome}
            onChangeText={setNome}
          />
        </View>

        <ScaledText style={commonStyles.label}>Email</ScaledText>
        <View style={commonStyles.inputWrapper}>
          <Ionicons name="mail-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={commonStyles.input}
            placeholder="usuario@gmail.com"
            placeholderTextColor={Colors.placeholder}
            value={email}
            onChangeText={setEmail}
            keyboardType="email-address"
            autoCapitalize="none"
          />
        </View>

        <ScaledText style={commonStyles.label}>CPF</ScaledText>
        <View style={commonStyles.inputWrapper}>
          <Ionicons name="card-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={commonStyles.input}
            placeholder="000.000.000-00"
            placeholderTextColor={Colors.placeholder}
            value={cpf}
            onChangeText={(texto) => setCpf(formatarCpf(texto))}
            keyboardType="numeric"
            maxLength={14}
          />
        </View>

     <View>
       <ScaledText style={commonStyles.label}>Data de nascimento</ScaledText>
      <View style={commonStyles.inputWrapper}>
      <Ionicons 
        name="calendar-outline" 
        size={20} 
        color={Colors.inputIcon} 
        style={commonStyles.inputIconStyle} 
      />
      <ScaledTextInput
        style={commonStyles.input}
        placeholder="DD/MM/AAAA"
        placeholderTextColor={Colors.placeholder}
        value={dataNascimento}
        onChangeText={handleDataChange}
        keyboardType="numeric"
        maxLength={10}
      />
     </View>
    </View>

        <ScaledText style={commonStyles.label}>Senha</ScaledText>
        <View style={commonStyles.inputWrapper}>
          <Ionicons name="lock-closed-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={commonStyles.input}
            placeholder="Digite sua senha"
            placeholderTextColor={Colors.placeholder}
            value={senha}
            onChangeText={setSenha}
            secureTextEntry={!mostrarSenha}
          />
          <TouchableOpacity onPress={() => setMostrarSenha(!mostrarSenha)}>
            <Ionicons
              name={mostrarSenha ? "eye-outline" : "eye-off-outline"}
              size={20}
              color={Colors.inputIcon}
            />
          </TouchableOpacity>
        </View>

        <ScaledText style={commonStyles.label}>Confirmar senha</ScaledText>
        <View style={commonStyles.inputWrapper}>
          <Ionicons name="lock-closed-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
          <ScaledTextInput
            style={commonStyles.input}
            placeholder="Confirme sua senha"
            placeholderTextColor={Colors.placeholder}
            value={confirmarSenha}
            onChangeText={setConfirmarSenha}
            secureTextEntry={!mostrarConfirmarSenha}
          />
          <TouchableOpacity onPress={() => setMostrarConfirmarSenha(!mostrarConfirmarSenha)}>
            <Ionicons
              name={mostrarConfirmarSenha ? "eye-outline" : "eye-off-outline"}
              size={20}
              color={Colors.inputIcon}
            />
          </TouchableOpacity>
        </View>

        <TouchableOpacity
          style={styles.termosRow}
          onPress={() => setAceitouTermos(!aceitouTermos)}
          activeOpacity={0.7}
        >
          <View style={[styles.checkbox, aceitouTermos && styles.checkboxChecked]}>
            {aceitouTermos && (
              <Ionicons name="checkmark" size={14} color={Colors.white} />
            )}
          </View>
          <ScaledText style={styles.termosText}>
            Li e aceito os{" "}
            <ScaledText
              style={commonStyles.link}
              onPress={() => Alert.alert("Termos de Uso", "Aqui deve abrir a tela/link com os Termos de Uso.")}
            >
              Termos de Uso
            </ScaledText>{" "}
            e a{" "}
            <ScaledText
              style={commonStyles.link}
              onPress={() => Alert.alert("Política de Privacidade", "Aqui deve abrir a tela/link com a Política de Privacidade.")}
            >
              Política de Privacidade
            </ScaledText>
            , incluindo como meus dados de saúde são protegidos.
          </ScaledText>
        </TouchableOpacity>

        <TouchableOpacity
          style={[commonStyles.button, loading && commonStyles.buttonDisabled]}
          onPress={cadastrar}
          disabled={loading}
        >
          <ScaledText style={commonStyles.buttonText}>
            {loading ? "Cadastrando..." : "Continuar"}
          </ScaledText>
        </TouchableOpacity>

        <TouchableOpacity
          onPress={() => navigation.navigate("Login")}
        >
          <ScaledText style={commonStyles.footerText}>
            Já tenho uma conta
          </ScaledText>
        </TouchableOpacity>

      </View>

      </ScrollView>
      {modal}
    </View>
  );
}

const styles = StyleSheet.create({
  scroll: {
    flex: 1,
  },
  termosRow: {
    flexDirection: "row",
    alignItems: "flex-start",
    marginTop: Spacing.md,
  },
  checkbox: {
    width: 20,
    height: 20,
    borderRadius: 5,
    borderWidth: 2,
    borderColor: Colors.primaryDark,
    marginRight: 8,
    marginTop: 2,
    justifyContent: "center",
    alignItems: "center",
  },
  checkboxChecked: {
    backgroundColor: Colors.primaryDark,
  },
  termosText: {
    flex: 1,
    fontSize: 12,
    color: Colors.textDark,
    lineHeight: 17,
  },
});
