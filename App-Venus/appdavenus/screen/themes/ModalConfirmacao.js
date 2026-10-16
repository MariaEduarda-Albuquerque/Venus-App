import { Text as ScaledText } from '../../context/ScaledText';
import React, { useCallback, useState } from "react";
import { Modal, View, Text, TouchableOpacity, StyleSheet } from "react-native";
import { Ionicons } from "@expo/vector-icons";
import { Colors, Spacing, commonStyles } from "./theme";


const ICONES = {
  sucesso: { nome: "checkmark-circle", cor:  Colors.primaryDark },
  erro: { nome: "close-circle", cor:  Colors.primaryDark },
  confirmar: { nome: "help-circle", cor: Colors.primaryDark },
  perigo: { nome: "warning", cor: Colors.primaryDark },
};

export default function ModalConfirmacao({
  visible,
  tipo = "sucesso",
  titulo,
  mensagem,
  textoConfirmar = "OK",
  textoCancelar,
  onConfirmar,
  onCancelar,
}) {
  const icone = ICONES[tipo] || ICONES.sucesso;

  return (
    <Modal
      visible={!!visible}
      transparent
      animationType="fade"
      onRequestClose={textoCancelar ? onCancelar : onConfirmar}
    >
      <View style={styles.overlay}>
        <View style={styles.caixa}>
          <Ionicons name={icone.nome} size={56} color={icone.cor} />

          {!!titulo && <ScaledText style={styles.titulo}>{titulo}</ScaledText>}
          {!!mensagem && <ScaledText style={styles.mensagem}>{mensagem}</ScaledText>}

          <View style={styles.botoes}>
            <TouchableOpacity
              style={tipo === "perigo" ? commonStyles.buttonDanger : commonStyles.button}
              onPress={onConfirmar}
            >
              <ScaledText style={commonStyles.buttonText}>{textoConfirmar}</ScaledText>
            </TouchableOpacity>

            {!!textoCancelar && (
              <TouchableOpacity
                style={commonStyles.buttonSecondary}
                onPress={onCancelar}
              >
                <ScaledText style={commonStyles.buttonSecondaryText}>{textoCancelar}</ScaledText>
              </TouchableOpacity>
            )}
          </View>
        </View>
      </View>
    </Modal>
  );
}


export function useModalConfirmacao() {
  const [config, setConfig] = useState({ visible: false });

  const mostrarModal = useCallback((opcoes) => {
    setConfig({ ...opcoes, visible: true });
  }, []);

  const fecharModal = useCallback(() => {
    setConfig((atual) => ({ ...atual, visible: false }));
  }, []);

  const modal = (
    <ModalConfirmacao
      {...config}
      onConfirmar={() => {
        const callback = config.onConfirmar;
        fecharModal();
        if (callback) callback();
      }}
      onCancelar={() => {
        const callback = config.onCancelar;
        fecharModal();
        if (callback) callback();
      }}
    />
  );

  return { modal, mostrarModal, fecharModal };
}

const styles = StyleSheet.create({
  overlay: {
    flex: 1,
    backgroundColor: "rgba(0,0,0,0.45)",
    justifyContent: "center",
    padding: Spacing.lg,
  },
  caixa: {
    backgroundColor: Colors.white,
    borderRadius: 20,
    padding: Spacing.lg,
    alignItems: "center",
  },
  titulo: {
    fontSize: 18,
    fontWeight: "bold",
    color: Colors.textDark,
    textAlign: "center",
    marginTop: Spacing.sm,
  },
  mensagem: {
    fontSize: 14,
    color: Colors.textDark,
    opacity: 0.8,
    textAlign: "center",
    marginTop: Spacing.sm,
  },
  botoes: {
    alignSelf: "stretch",
  },
});
