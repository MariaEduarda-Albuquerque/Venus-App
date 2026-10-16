import { Text as ScaledText, TextInput as ScaledTextInput } from '../../context/ScaledText';
import React, { useState } from "react";

import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Alert,
  StyleSheet,
  Image,
} from "react-native";

import api from "../../api/api";

import { Ionicons } from "@expo/vector-icons";
import { CommonActions } from "@react-navigation/native";

import { Colors, Spacing, commonStyles } from "../themes/theme";
import FundoOndas from "../themes/FundoOndas";
import { useAuth } from "../../context/AuthContext";


export default function Login({ navigation }) {

  const { signIn } = useAuth();

  const [email, setEmail] = useState("");
  const [senha, setSenha] = useState("");

  const [loading, setLoading] = useState(false);

  const [mostrarSenha, setMostrarSenha] = useState(false);

  const fazerLogin = async () => {

    if (!email || !senha) {

      Alert.alert(
        "Atenção",
        "Preencha seu e-mail e sua senha."
      );

      return;
    }

    setLoading(true);

    try {

      const response = await api.post(
        `/login`,
        {
          emailUsuario: email.trim().toLowerCase(),
          senhaUsuario: senha
        }
      );

      const usuario = response.data.usuario;

      await signIn({
        ...usuario,
        id: usuario.codUsuario,
        codUsuario: usuario.codUsuario,
        nome: usuario.nomeUsuario ?? usuario.nome ?? usuario.name ?? "",
      }, response.data.token);

      Alert.alert(
        "Sucesso",
        "Login realizado com sucesso!"
      );

      navigation.dispatch(
        CommonActions.reset({
          index: 0,
          routes: [{ name: "Home" }],
        })
      );

    } catch (error) {

      if (error.response?.data?.errors) {

        const erros =
          error.response.data.errors;

        const primeiraMensagem =
          Object.values(erros)[0][0];

        Alert.alert(
          "Erro",
          primeiraMensagem
        );

      } else {

        Alert.alert(
          "Erro",
          error.response?.data?.message ||
          "E-mail ou senha incorretos."
        );

      }

    } finally {

      setLoading(false);

    }
  };

  return (

    <View style={commonStyles.screen}>
      <FundoOndas variant="login" />
      <View style={styles.scrollContent}>
        <View style={commonStyles.card}>

          <Image source={require("../../assets/logovenussemtexto.png")} style={styles.logoImage} />

          <ScaledText style={commonStyles.title}>Bem vinda de volta!</ScaledText>
          <ScaledText style={commonStyles.subtitle}>Comece a cuidar da sua saúde</ScaledText>

          <ScaledText style={commonStyles.label}>Email</ScaledText>
          <View style={commonStyles.inputWrapper}>
            <Ionicons
              name="mail-outline"
              size={20}
              color={Colors.inputIcon}
              style={commonStyles.inputIconStyle}
            />
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

          <ScaledText style={commonStyles.label}>Senha</ScaledText>
          <View style={commonStyles.inputWrapper}>
            <Ionicons
              name="lock-closed-outline"
              size={20}
              color={Colors.inputIcon}
              style={commonStyles.inputIconStyle}
            />
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

          <TouchableOpacity
            onPress={() => navigation.navigate("EsqueciSenha")}
            style={styles.forgotWrapper}
          >
            <ScaledText style={commonStyles.link}>Esqueceu a senha?</ScaledText>
          </TouchableOpacity>

          <TouchableOpacity
            style={[commonStyles.button, loading && commonStyles.buttonDisabled]}
            onPress={fazerLogin}
            disabled={loading}
          >
            <ScaledText style={commonStyles.buttonText}>
              {loading ? "Entrando..." : "Continuar"}
            </ScaledText>
          </TouchableOpacity>

          <TouchableOpacity
            onPress={() => navigation.navigate("Cadastro")}
          >
            <ScaledText style={commonStyles.footerText}>
              Não tem uma conta?{" "}
              <ScaledText style={commonStyles.link}>Registre-se aqui.</ScaledText>
            </ScaledText>
          </TouchableOpacity>

        </View>
      </View>
    </View>

  );
}

const styles = StyleSheet.create({
  scrollContent: {
    flex: 1,
    justifyContent: "center",
    padding: Spacing.lg,
  },
  forgotWrapper: {
    alignSelf: "flex-end",
    marginTop: 6,
  },
  logoImage: {
    width: 90,
    height: 90,
    alignSelf: "center",
    marginBottom: Spacing.md,
    resizeMode: "contain",
  },
});
