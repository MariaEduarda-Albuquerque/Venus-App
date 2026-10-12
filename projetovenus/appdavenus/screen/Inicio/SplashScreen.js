import React, { useEffect, useRef } from "react";
import { View, Image, StyleSheet, Animated, Dimensions, Easing } from "react-native";
import Svg, { Path } from "react-native-svg";


const { width } = Dimensions.get("window");
const COMPRIMENTO_ONDA = width * 0.7;
const LARGURA_SVG = COMPRIMENTO_ONDA * 4;
const ALTURA_FAIXA = width * 0.55;

function criarPathOnda(alturaBase, amplitude) {
  let d = `M0,${alturaBase}`;
  let x = 0;
  let subindo = true;

  while (x < LARGURA_SVG) {
    const controle = COMPRIMENTO_ONDA / 4;
    const proximoX = x + COMPRIMENTO_ONDA / 2;
    const y = alturaBase + (subindo ? -amplitude : amplitude);

    d += ` C ${x + controle},${y} ${proximoX - controle},${y} ${proximoX},${alturaBase}`;

    x = proximoX;
    subindo = !subindo;
  }

  d += ` L ${LARGURA_SVG},${ALTURA_FAIXA} L 0,${ALTURA_FAIXA} Z`;

  return d;
}

const ONDA_FUNDO = criarPathOnda(ALTURA_FAIXA * 0.35, width * 0.05);
const ONDA_MEIO = criarPathOnda(ALTURA_FAIXA * 0.5, width * 0.045);
const ONDA_FRENTE = criarPathOnda(ALTURA_FAIXA * 0.68, width * 0.04);

function CamadaOnda({ path, cor, duracao }) {

  const valor = useRef(new Animated.Value(0)).current;

  useEffect(() => {

    Animated.loop(
      Animated.timing(valor, {
        toValue: 1,
        duration: duracao,
        easing: Easing.linear,
        useNativeDriver: true,
      })
    ).start();

  }, []);

  const translateX = valor.interpolate({
    inputRange: [0, 1],
    outputRange: [0, -COMPRIMENTO_ONDA],
  });

  return (
    <Animated.View
      style={[styles.camadaOnda, { transform: [{ translateX }] }]}
    >
      <Svg width={LARGURA_SVG} height={ALTURA_FAIXA}>
        <Path d={path} fill={cor} />
      </Svg>
    </Animated.View>
  );
}

export default function SplashScreen({ navigation, route }) {

  useEffect(() => {

    const timeout = setTimeout(() => {
      const destino = route?.params?.nextRoute || "Slide1";
      navigation.replace(destino);
    }, 2500);

    return () => clearTimeout(timeout);

  }, []);

  return (
    <View style={styles.container}>
      <Image
        source={require("../../assets/venus.png")}
        style={styles.logo}
        resizeMode="contain"
      />

      <View style={styles.ondasContainer} pointerEvents="none">
        <CamadaOnda path={ONDA_FUNDO} cor="rgba(255,255,255,0.18)" duracao={7000} />
        <CamadaOnda path={ONDA_MEIO} cor="rgba(255,255,255,0.28)" duracao={5200} />
        <CamadaOnda path={ONDA_FRENTE} cor="rgba(255,255,255,0.4)" duracao={3800} />
      </View>

    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#F2AFBC",
    justifyContent: "center",
    alignItems: "center",
    overflow: "hidden",
  },

  logo: {
    width: 260,
    height: 260,
  },

  ondasContainer: {
    position: "absolute",
    bottom: 0,
    left: 0,
    right: 0,
    height: ALTURA_FAIXA,
    overflow: "hidden",
  },

  camadaOnda: {
    position: "absolute",
    bottom: 0,
    left: 0,
  },
});