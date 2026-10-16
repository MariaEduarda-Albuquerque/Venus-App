import React from 'react';
import { View, Image, StyleSheet, Dimensions } from 'react-native';
import { Colors } from './theme';

const { width, height } = Dimensions.get('window');

const VARIANT_IMAGES = {
  login: require('../../assets/Header.png'),
  cadastro: require('../../assets/Vector.png'),
  redefinir: require('../../assets/Linhas-1.png'),
  criarNovaSenha: require('../../assets/Linhas.png'),
};

export default function FundoOndas({ variant = 'login' }) {
  const source = VARIANT_IMAGES[variant] ?? VARIANT_IMAGES.login;

  return (
    <View style={styles.container} pointerEvents="none">
      <Image source={source} style={styles.image} resizeMode="cover" />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    position: 'absolute',
    top: 0,
    left: 0,
    right: 0,
    bottom: 0,
    backgroundColor: Colors.primary,
    overflow: 'hidden',
  },
  image: {
    position: 'absolute',
    top: 0,
    left: 0,
    width: width,
    height: height,
  },
});
