import { Text as ScaledText } from '../../context/ScaledText';
import { useNavigation } from '@react-navigation/native';
import { Image, SafeAreaView, StyleSheet, Text, TouchableOpacity, View } from 'react-native';
import { useOnboarding } from '../../hooks/useOnboarding';

export default function Slide1() {
  const navigation = useNavigation();
  const { finish } = useOnboarding();

  async function handleContinuar() {
    navigation.navigate('Slide2');
  }

  async function handlePular() {
    await finish();
    navigation.navigate('Inicio');
  }

  return (
    <SafeAreaView style={styles.container}>
      <View style={styles.topRow}>
        <TouchableOpacity onPress={handlePular}>
          <ScaledText style={styles.skipText}>Pular</ScaledText>
        </TouchableOpacity>
      </View>

      <View style={styles.mainContainer}>
        <View style={styles.illustrationWrapper}>
          <Image
            source={require('../../assets/icon-cycle.png')}
            style={styles.illustration}
            resizeMode="cover"
          />
        </View>

        <View style={styles.content}>
          <ScaledText style={styles.title}>
            Acompanhe seu <ScaledText style={styles.titleHighlight}>ciclo</ScaledText>
          </ScaledText>
          <ScaledText style={styles.subtitle}>
            Registre sintomas, humor e receba previsões pensadas pra sua rotina.
          </ScaledText>
        </View>
      </View>

      <View style={styles.footer}>
        <View style={styles.dotsRow}>
          <View style={[styles.dot, styles.dotActive]} />
          <View style={styles.dot} />
          <View style={styles.dot} />
        </View>

        <TouchableOpacity style={styles.continueButton} onPress={handleContinuar}>
          <ScaledText style={styles.continueText}>Continuar</ScaledText>
        </TouchableOpacity>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#FFF8F4',
    paddingHorizontal: 24,
  },
  topRow: {
    flexDirection: 'row',
    justifyContent: 'flex-end',
    alignItems: 'center',
    paddingTop: 16,
    paddingBottom: 8,
  },
  skipText: {
    color: '#3A1420',
    fontSize: 14,
    fontWeight: '500',
  },
  mainContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  illustrationWrapper: {
    alignItems: 'center',
    marginBottom: 24,
  },
  illustration: {
    width: 120,
    height: 120,
    borderRadius: 60,
  },
  content: {
    alignItems: 'center',
  },
  title: {
    fontSize: 24,
    fontWeight: '700',
    color: '#3A1420',
    marginBottom: 8,
    textAlign: 'center',
  },
  titleHighlight: {
    color: '#9E182B',
  },
  subtitle: {
    fontSize: 15,
    color: '#9B6B78',
    lineHeight: 21,
    textAlign: 'center',
  },
  footer: {
    paddingBottom: 24,
  },
  dotsRow: {
    flexDirection: 'row',
    justifyContent: 'center',
    marginBottom: 16,
  },
  dot: {
    width: 6,
    height: 6,
    borderRadius: 3,
    marginHorizontal: 3,
    backgroundColor: '#F6C9D6',
  },
  dotActive: {
    backgroundColor: '#9E182B',
  },
  continueButton: {
    backgroundColor: '#9E182B',
    borderRadius: 10,
    paddingVertical: 14,
    alignItems: 'center',
  },
  continueText: {
    fontSize: 15,
    fontWeight: '700',
    color: '#FFFFFF',
  },
});