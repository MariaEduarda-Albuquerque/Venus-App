import { Text as ScaledText } from '../../context/ScaledText';
import React from 'react';
import { SafeAreaView, View, Text, Image, TouchableOpacity, StyleSheet, Dimensions } from 'react-native';
import { CommonActions, useNavigation } from '@react-navigation/native';
import { useAuth } from '../../context/AuthContext';

const { width } = Dimensions.get('window');

export default function Inicio() {
  const navigation = useNavigation();
  const { continueAsGuest } = useAuth();

  async function irParaLogin() {
    navigation.navigate('Login');
  }

  async function continuarSemLogin() {
    await continueAsGuest();
    navigation.dispatch(CommonActions.reset({ index: 0, routes: [{ name: 'Home' }] }));
  }

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.headerContainer}>
        <Image
          source={require('../../assets/Vector 79.png')}
          style={styles.waveImage}
          resizeMode="stretch"
        />
      </View>

      <View style={styles.content}>
        <Image
          source={require('../../assets/Iconelogo.png')}
          style={styles.logo}
          resizeMode="contain"
        />

        <ScaledText style={styles.title}>Bem-vinda.</ScaledText>
        <ScaledText style={styles.subtitle}>Você está em um espaço seguro.</ScaledText>
        <ScaledText style={styles.paragraph}>
          Informação sem julgamento, uma comunidade que entende sua realidade
          e acesso direto à rede pública de saúde.
        </ScaledText>
        <ScaledText style={styles.paragraphBold}>Tudo num só lugar, de graça.</ScaledText>
      </View>

      <View style={styles.footer}>
        <TouchableOpacity style={styles.primaryButton} onPress={irParaLogin}>
          <ScaledText style={styles.primaryButtonText}>Entrar / Registrar</ScaledText>
        </TouchableOpacity>

        <TouchableOpacity onPress={continuarSemLogin}>
          <ScaledText style={styles.guestLink}>Continuar sem login</ScaledText>
        </TouchableOpacity>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFF4F6',
  },
  headerContainer: {
    width: '100%',
    height: 160,
  },
  waveImage: {
    width: width,
    height: 160,
  },
  content: {
    flex: 1,
    paddingHorizontal: 28,
    paddingTop: 8,
  },
  logo: {
    width: 28,
    height: 38,
    marginBottom: 16,
  },
  title: {
    fontSize: 26,
    fontWeight: '700',
    color: '#2A0812',
  },
  subtitle: {
    fontSize: 22,
    fontWeight: '700',
    color: '#9E182B',
    marginTop: 2,
    marginBottom: 16,
  },
  paragraph: {
    fontSize: 14,
    lineHeight: 20,
    color: '#8A5E6B',
    marginBottom: 6,
  },
  paragraphBold: {
    fontSize: 14,
    lineHeight: 20,
    fontWeight: '700',
    color: '#2A0812',
  },
  footer: {
    paddingHorizontal: 28,
    paddingBottom: 28,
  },
  primaryButton: {
    backgroundColor: '#9E182B',
    borderRadius: 8,
    paddingVertical: 14,
    alignItems: 'center',
    marginBottom: 12,
  },
  primaryButtonText: {
    fontSize: 15,
    fontWeight: '700',
    color: '#FFFFFF',
  },
  guestLink: {
    fontSize: 13,
    fontWeight: '600',
    color: '#9E182B',
    textAlign: 'center',
    textDecorationLine: 'underline',
  },
});
