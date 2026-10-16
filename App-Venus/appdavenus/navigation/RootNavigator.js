import { Text as ScaledText } from '../context/ScaledText';
import React, { useEffect, useState } from 'react';
import { View, ActivityIndicator, Text, StyleSheet } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { useAuth } from '../context/AuthContext';
import { hasCompletedOnboarding } from '../hooks/useOnboarding';
import { Colors } from '../screen/themes/theme';
import SplashScreen from '../screen/Inicio/SplashScreen';
import Slide1 from '../screen/Inicio/Slide1';
import Slide2 from '../screen/Inicio/Slide2';
import Slide3 from '../screen/Inicio/Slide3';
import Inicio from '../screen/Inicio/Inicio';
import Login from '../screen/CadastroeLogin/Login';
import Cadastro from '../screen/CadastroeLogin/Cadastro';
import EsqueciSenha from '../screen/senhas/EsqueciSenha';
import CriarNovaSenha from '../screen/senhas/CriarNovaSenha';
import Perfil from '../screen/perfil/Perfil';
import EditarPerfil from '../screen/perfil/EditarPerfil';
import Home from '../screen/home/Home';
import Configuracao from '../screen/configuracao/Configuracao';
import DadosPessoais from '../screen/configuracao/DadosPessoais';
import Privacidade from '../screen/configuracao/Privacidade';
import Aparencia from '../screen/configuracao/Aparencia';
import Notificacoes from '../screen/configuracao/Notificacoes';
import FiltrosInteresse from '../screen/configuracao/FiltrosInteresse';
import PoliticaPrivacidade from '../screen/configuracao/PoliticaPrivacidade';
import CentralAjuda from '../screen/configuracao/CentralAjuda';

const Stack = createNativeStackNavigator();

export function RootNavigator() {
  const { isGuest, user, isLoadingSession } = useAuth();
  const [hasOnboarded, setHasOnboarded] = useState(null);

  useEffect(() => {
    let settled = false;
    const timeoutId = setTimeout(() => {
      if (!settled) {
        settled = true;
        setHasOnboarded(false);
      }
    }, 4000);

    hasCompletedOnboarding()
      .then((value) => {
        if (!settled) {
          settled = true;
          setHasOnboarded(value);
        }
      })
      .catch(() => {
        if (!settled) {
          settled = true;
          setHasOnboarded(false);
        }
      })
      .finally(() => clearTimeout(timeoutId));

    return () => clearTimeout(timeoutId);
  }, []);

  if (hasOnboarded === null || isLoadingSession) {
    return (
      <View style={styles.loading}>
        <ActivityIndicator size="large" color={Colors.primary} />
        <ScaledText style={styles.loadingText}>Carregando...</ScaledText>
      </View>
    );
  }

  const isAuthenticated = isGuest || !!user;
  const initialRouteName = hasOnboarded ? (isAuthenticated ? 'Home' : 'Inicio') : 'Slide1';

  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="SplashScreen" screenOptions={{ headerShown: false }}>
        <Stack.Screen name="SplashScreen">{(props) => <SplashScreen {...props} route={{ ...props.route, params: { ...(props.route.params || {}), nextRoute: initialRouteName } }} />}</Stack.Screen>
        <Stack.Screen name="Slide1" component={Slide1} />
        <Stack.Screen name="Slide2" component={Slide2} />
        <Stack.Screen name="Slide3" component={Slide3} />
        <Stack.Screen name="Inicio" component={Inicio} />
        <Stack.Screen name="Login" component={Login} />
        <Stack.Screen name="Cadastro" component={Cadastro} />
        <Stack.Screen name="EsqueciSenha" component={EsqueciSenha} />
        <Stack.Screen name="CriarNovaSenha" component={CriarNovaSenha} />
        <Stack.Screen name="Perfil" component={Perfil} />
        <Stack.Screen name="EditarPerfil" component={EditarPerfil} />
        <Stack.Screen name="Home" component={Home} />
        <Stack.Screen name="Configuracoes" component={Configuracao} />
        <Stack.Screen name="DadosPessoais" component={DadosPessoais} />
        <Stack.Screen name="Privacidade" component={Privacidade} />
        <Stack.Screen name="Aparencia" component={Aparencia} />
        <Stack.Screen name="Notificacoes" component={Notificacoes} />
        <Stack.Screen name="FiltrosInteresse" component={FiltrosInteresse} />
        <Stack.Screen name="PoliticaPrivacidade" component={PoliticaPrivacidade} />
        <Stack.Screen name="CentralAjuda" component={CentralAjuda} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

const styles = StyleSheet.create({
  loading: {
    flex: 1,
    backgroundColor: Colors.background,
    alignItems: 'center',
    justifyContent: 'center',
  },
  loadingText: {
    marginTop: 12,
    color: Colors.textMuted,
    fontSize: 13,
  },
});
