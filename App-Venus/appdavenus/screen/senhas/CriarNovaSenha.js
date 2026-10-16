import { Text as ScaledText, TextInput as ScaledTextInput } from '../../context/ScaledText';
import React, { useState } from "react";

import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Alert,
  StyleSheet,
} from "react-native";

import api from "../../api/api";
import { Ionicons } from "@expo/vector-icons";
import { Colors, Spacing, commonStyles } from "../themes/theme";
import FundoOndas from "../themes/FundoOndas";
import { useModalConfirmacao } from "../themes/ModalConfirmacao";


export default function CriarNovaSenha({ route, navigation }) {

  const { modal, mostrarModal } = useModalConfirmacao();

  const email = route?.params?.email;
  const codigo = route?.params?.codigo;

  const [senha, setSenha] = useState("");
  const [confirmarSenha, setConfirmarSenha] = useState("");
  const [mostrarSenha, setMostrarSenha] = useState(false);
  const [mostrarConfirmarSenha, setMostrarConfirmarSenha] = useState(false);
  const [salvando, setSalvando] = useState(false);

  const calcularForca = (valor) => {
    let pontos = 0;
    if (valor.length >= 8) pontos++;
    if (/[a-z]/.test(valor)) pontos++;
    if (/[A-Z]/.test(valor)) pontos++;
    if (/[0-9]/.test(valor)) pontos++;
    if (/[^A-Za-z0-9]/.test(valor)) pontos++;
    return pontos;
  };

  const pontosForca = calcularForca(senha);

  let labelForca = "Fraca";
  let corForca = Colors.danger;
  if (pontosForca >= 4) {
    labelForca = "Forte";
    corForca = Colors.success;
  } else if (pontosForca >= 2) {
    labelForca = "Média";
    corForca = "#D68C1D";
  }

  const criarConta = async () => {

    if (!senha || !confirmarSenha) {
      Alert.alert("Atenção", "Preencha os dois campos de senha.");
      return;
    }

    if (senha.length < 8) {
      Alert.alert("Atenção", "A senha deve ter no mínimo 8 caracteres.");
      return;
    }

    if (senha !== confirmarSenha) {
      Alert.alert("Erro", "As senhas não coincidem.");
      return;
    }

    setSalvando(true);

    try {

      await api.post(`/redefinir-senha/confirmar`, {
        emailUsuario: email,
        codigo: codigo,
        novaSenha: senha,
      });

      mostrarModal({
        tipo: "sucesso",
        titulo: "Senha alterada!",
        mensagem: "Sua senha foi alterada com sucesso. Entre com a nova senha.",
        textoConfirmar: "Ir para o login",
        onConfirmar: () => navigation.navigate("Login"),
      });

    } catch (error) {

      console.log("ERRO AO CRIAR NOVA SENHA:", error.response?.data);

      Alert.alert(
        "Erro",
        error.response?.data?.message ||
        "Não foi possível alterar a senha. Confira o código e tente novamente."
      );

    } finally {
      setSalvando(false);
    }
  };

  return (
    <View style={commonStyles.screen}>
      <FundoOndas variant="criarNovaSenha" />
      <View style={styles.content}>
        <View style={commonStyles.card}>

          <ScaledText style={commonStyles.title}>Criar nova senha</ScaledText>
          <ScaledText style={commonStyles.subtitle}>
            Vamos criar uma senha nova e mais segura
          </ScaledText>

          <ScaledText style={commonStyles.label}>Senha</ScaledText>
          <View style={commonStyles.inputWrapper}>
            <Ionicons name="lock-closed-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
            <ScaledTextInput
              style={commonStyles.input}
              placeholder="Digite a nova senha"
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
              placeholder="Digite a senha novamente"
              placeholderTextColor={Colors.placeholder}
              value={confirmarSenha}
              onChangeText={setConfirmarSenha}
              secureTextEntry={!mostrarConfirmarSenha}
            />
            <TouchableOpacity onPress={() => setMostrarConfirmarSenha(!mostrarConfirmarSenha)}>
              <Ionicons
                name={mostrarConfirmarSenha ? "eye-off-outline" : "eye-outline"}
                size={20}
                color={Colors.inputIcon}
              />
            </TouchableOpacity>
          </View>

          <ScaledText style={styles.dica}>
            Mínimo de 8 caracteres e uma combinação de letras e números.
          </ScaledText>

          <View style={styles.barraRow}>
            <View style={styles.barraContainer}>
              {[0, 1, 2, 3].map((i) => (
                <View
                  key={i}
                  style={[
                    styles.barraSegmento,
                    { backgroundColor: i < pontosForca ? corForca : Colors.border },
                  ]}
                />
              ))}
            </View>
            {senha.length > 0 && (
              <ScaledText style={[styles.labelForca, { color: corForca }]}>{labelForca}</ScaledText>
            )}
          </View>

          <TouchableOpacity
            style={[commonStyles.button, salvando && commonStyles.buttonDisabled]}
            onPress={criarConta}
            disabled={salvando}
          >
            <ScaledText style={commonStyles.buttonText}>
              {salvando ? "Salvando..." : "Criar nova Senha"}
            </ScaledText>
          </TouchableOpacity>

        </View>
      </View>
      {modal}
    </View>
  );
}

const styles = StyleSheet.create({
  content: {
    flex: 1,
    justifyContent: "center",
    padding: Spacing.lg,
  },
  dica: {
    fontSize: 12,
    color: Colors.textDark,
    opacity: 0.7,
    marginTop: Spacing.sm,
  },
  barraRow: {
    flexDirection: "row",
    alignItems: "center",
    marginTop: Spacing.sm,
  },
  barraContainer: {
    flexDirection: "row",
    flex: 1,
  },
  barraSegmento: {
    height: 6,
    flex: 1,
    borderRadius: 3,
    marginRight: 4,
  },
  labelForca: {
    marginLeft: 8,
    fontSize: 12,
    fontWeight: "bold",
  },
});
