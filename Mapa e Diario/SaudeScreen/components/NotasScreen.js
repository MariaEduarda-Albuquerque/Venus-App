
import React, { useState } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  Alert,
} from 'react-native';
import estilos from '../styles';

export default function NotasScreen() {
  const [nota, setNota] = useState('');

  const salvarNota = () => {
    if (nota.trim().length === 0) {
      Alert.alert('Aviso', 'Digite algo antes de salvar.');
      return;
    }
    Alert.alert('Nota salva', `Sua nota:\n\n${nota}`);
  };

  const limparNota = () => {
    Alert.alert(
      'Limpar nota',
      'Tem certeza que deseja apagar todo o conteúdo?',
      [
        { text: 'Cancelar', style: 'cancel' },
        { text: 'Limpar', onPress: () => setNota(''), style: 'destructive' },
      ],
      { cancelable: true }
    );
  };

  return (
    <View style={estilos.containerNotas}>
      <View style={estilos.cardNotasSeguranca}>
        <Text style={estilos.textoSeguranca}>
          Diário protegido por biometria ou senha.{'\n'}Apenas você vê isso.
        </Text>
      </View>

      <View style={estilos.cardNotasTexto}>
        <TextInput
          style={estilos.inputNota}
          multiline
          placeholder="Escreva seus pensamentos, sentimentos, dúvidas... Este é seu espaço seguro."
          placeholderTextColor="rgba(97,17,28,0.7)"
          value={nota}
          onChangeText={setNota}
          textAlignVertical="top"
          numberOfLines={10}
          selectionColor="#AA1B31"
          underlineColorAndroid="transparent"
        />
      </View>

      <View style={estilos.linhaBotoesNotas}>
        <TouchableOpacity style={estilos.botaoSalvarNota} onPress={salvarNota}>
          <Text style={estilos.textoBotaoSalvarNota}>Salvar</Text>
        </TouchableOpacity>

        <TouchableOpacity style={estilos.botaoLimparNota} onPress={limparNota}>
          <Text style={estilos.textoBotaoLimparNota}>Limpar</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}