import { Text as ScaledText, TextInput as ScaledTextInput } from '../../context/ScaledText';
import React, { useState } from "react";
import { View, Text, TextInput, TouchableOpacity, Alert, StyleSheet } from "react-native";
import { Ionicons } from "@expo/vector-icons";
import { Colors, Spacing, commonStyles } from "../themes/theme";
import FundoOndas from "../themes/FundoOndas";
import { useModalConfirmacao } from "../themes/ModalConfirmacao";
import api from "../../api/api";


export default function EsqueciSenha({ navigation }) {
  const { modal, mostrarModal } = useModalConfirmacao();

  const [email, setEmail] = useState("");
  const [loading, setLoading] = useState(false);
  const [codigo, setCodigo] = useState("");
  const [codigoEnviado, setCodigoEnviado] = useState(false);

  const enviarInstrucoes = async () => {
    if (!email.trim()) return Alert.alert("Atenção", "Digite o e-mail cadastrado.");
    setLoading(true);
    try {
      await api.post("/redefinir-senha", { emailUsuario: email.trim().toLowerCase() });
      setCodigoEnviado(true);
      Alert.alert("Confira seu e-mail", "Se o endereço estiver cadastrado, você receberá um código de verificação.");
    } catch (error) {
      Alert.alert("Erro", error.response?.data?.message || "Não foi possível solicitar o código agora.");
    } finally { setLoading(false); }
  };

  const verificarCodigo = async () => {
    if (!/^\d{6}$/.test(codigo.trim())) return Alert.alert("Código inválido", "Digite o código de 6 números recebido por e-mail.");
    setLoading(true);
    try {
      await api.post("/redefinir-senha/verificar", { emailUsuario: email.trim().toLowerCase(), codigo: codigo.trim() });
      navigation.navigate("CriarNovaSenha", { email: email.trim().toLowerCase(), codigo: codigo.trim() });
    } catch (error) {
      Alert.alert("Código inválido", error.response?.data?.message || "O código está incorreto ou expirou.");
    } finally { setLoading(false); }
  };

  return (
    <View style={commonStyles.screen}>
      <FundoOndas variant="redefinir" />
      <View style={styles.content}>
        <View style={commonStyles.card}>
          <ScaledText style={commonStyles.title}>Esqueceu a senha?</ScaledText>
          <ScaledText style={commonStyles.subtitle}>
            Digite seu e-mail e enviaremos as instruções para redefinir sua senha.
          </ScaledText>

          <ScaledText style={commonStyles.label}>Email</ScaledText>
          <View style={commonStyles.inputWrapper}>
            <Ionicons name="mail-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
            <ScaledTextInput
              style={commonStyles.input}
              placeholder="exemplo@gmail.com"
              placeholderTextColor={Colors.placeholder}
              value={email}
              onChangeText={setEmail}
              keyboardType="email-address"
              autoCapitalize="none"
            />
          </View>

          {codigoEnviado && <>
            <ScaledText style={commonStyles.label}>Código de verificação</ScaledText>
            <View style={commonStyles.inputWrapper}>
              <Ionicons name="key-outline" size={20} color={Colors.inputIcon} style={commonStyles.inputIconStyle} />
              <ScaledTextInput style={commonStyles.input} placeholder="Código de 6 dígitos" placeholderTextColor={Colors.placeholder}
                value={codigo} onChangeText={(v) => setCodigo(v.replace(/\D/g, "").slice(0, 6))} keyboardType="number-pad" maxLength={6} />
            </View>
          </>}
          <TouchableOpacity style={[commonStyles.button, loading && commonStyles.buttonDisabled]}
            onPress={codigoEnviado ? verificarCodigo : enviarInstrucoes} disabled={loading}>
            <ScaledText style={commonStyles.buttonText}>{loading ? "Aguarde..." : codigoEnviado ? "Verificar código" : "Enviar instruções"}</ScaledText>
          </TouchableOpacity>

          <TouchableOpacity onPress={() => navigation.navigate("Login")}>
            <ScaledText style={commonStyles.footerText}>Voltar para o login</ScaledText>
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
});
