import { Text as ScaledText } from '../../context/ScaledText';
import React from "react";
import { View, Text, Image, TouchableOpacity, Alert, StyleSheet } from "react-native";
import { Ionicons } from "@expo/vector-icons";
import * as ImagePicker from "expo-image-picker";
import { Colors, commonStyles } from "./theme";

// Círculo de foto de perfil com botão de câmera.
// uri: foto atual (url remota ou uri local); onChange(uriLocal): chamado ao escolher uma nova.
export default function SeletorFoto({ uri, onChange, tamanho = 96, desabilitado = false }) {

  const escolherFoto = async () => {

    const permissao = await ImagePicker.requestMediaLibraryPermissionsAsync();

    if (!permissao.granted) {
      Alert.alert(
        "Permissão necessária",
        "Permita o acesso às suas fotos para escolher uma foto de perfil."
      );
      return;
    }

    const resultado = await ImagePicker.launchImageLibraryAsync({
      allowsEditing: true,
      aspect: [1, 1],
      quality: 0.7,
    });

    if (!resultado.canceled && resultado.assets?.length) {
      onChange(resultado.assets[0].uri);
    }
  };

  return (
    <View style={styles.container}>
      <TouchableOpacity
        onPress={escolherFoto}
        disabled={desabilitado}
        activeOpacity={0.8}
        style={{ width: tamanho, height: tamanho }}
      >
        <View
          style={[
            styles.circulo,
            { width: tamanho, height: tamanho, borderRadius: tamanho / 2 },
          ]}
        >
          {uri ? (
            <Image source={{ uri }} style={{ width: tamanho, height: tamanho }} resizeMode="cover" />
          ) : (
            <Ionicons name="person" size={tamanho * 0.45} color="#9E182B" />
          )}
        </View>

        <View style={styles.badge}>
          <Ionicons name="camera" size={16} color={Colors.white} />
        </View>
      </TouchableOpacity>

      <TouchableOpacity onPress={escolherFoto} disabled={desabilitado}>
        <ScaledText style={[commonStyles.link, styles.texto]}>
          {uri ? "Alterar foto" : "Adicionar foto"}
        </ScaledText>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    alignItems: "center",
    marginBottom: 12,
  },
  circulo: {
    backgroundColor: "rgba(240,175,190,0.2)",
    overflow: "hidden",
    alignItems: "center",
    justifyContent: "center",
  },
  badge: {
    position: "absolute",
    right: 0,
    bottom: 0,
    width: 30,
    height: 30,
    borderRadius: 15,
    backgroundColor: Colors.primaryDark,
    alignItems: "center",
    justifyContent: "center",
    borderWidth: 2,
    borderColor: Colors.white,
  },
  texto: {
    marginTop: 8,
  },
});
