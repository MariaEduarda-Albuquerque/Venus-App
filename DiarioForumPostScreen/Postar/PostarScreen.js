import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, SafeAreaView, StatusBar } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import styles from './style';

export default function PostarScreen({ navegar }) {
  const [texto, setTexto] = useState('');

  return (
    <SafeAreaView style={styles.safe}>
      <StatusBar barStyle="dark-content" backgroundColor="#F8DDE4" />

      <View style={styles.topo}>
        <TouchableOpacity style={styles.botaoCancelar} onPress={() => navegar('Forum')}>
          <Text style={styles.textoCancelar}>Cancelar</Text>
        </TouchableOpacity>

        <TouchableOpacity style={styles.botaoPostar} onPress={() => navegar('Forum')}>
          <Text style={styles.textoPostar}>Postar</Text>
        </TouchableOpacity>
      </View>

      <View style={styles.card}>
        <View style={styles.linhaEscrita}>
          <View style={styles.avatar}>
            <Ionicons name="person" size={16} color="#FFFFFF" />
          </View>
          <TextInput
            style={styles.input}
            placeholder="O que você está pensando...?"
            placeholderTextColor="rgba(170, 27, 49, 0.45)"
            value={texto}
            onChangeText={setTexto}
            multiline
          />
        </View>

        <View style={styles.rodape}>
          <TouchableOpacity>
            <Ionicons name="image-outline" size={22} color="#F2AFBC" />
          </TouchableOpacity>
          <TouchableOpacity>
            <Ionicons name="camera-outline" size={22} color="#F2AFBC" />
          </TouchableOpacity>

          <View style={styles.espaco} />

          <TouchableOpacity>
            <Ionicons name="arrow-back" size={18} color="#F2AFBC" />
          </TouchableOpacity>
          <TouchableOpacity>
            <Ionicons name="arrow-forward" size={18} color="#F2AFBC" />
          </TouchableOpacity>
        </View>
      </View>
    </SafeAreaView>
  );
}
