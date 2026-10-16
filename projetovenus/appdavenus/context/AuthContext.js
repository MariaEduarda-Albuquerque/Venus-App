import React, { createContext, useContext, useEffect, useMemo, useState } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';

const GUEST_KEY = 'venus_guest_mode';
const USER_KEY = 'venus_user';
const TOKEN_KEY = 'venus_api_token';

const AuthContext = createContext(null);

export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [isGuest, setIsGuest] = useState(false);
  const [isLoadingSession, setIsLoadingSession] = useState(true);

  useEffect(() => {
    loadSession();
  }, []);

  async function loadSession() {
    setIsLoadingSession(true);
    try {
      const [guestValue, userRaw, token] = await Promise.all([
        AsyncStorage.getItem(GUEST_KEY),
        AsyncStorage.getItem(USER_KEY),
        AsyncStorage.getItem(TOKEN_KEY),
      ]);
      const guest = guestValue === 'true';
      const savedUser = userRaw ? JSON.parse(userRaw) : null;
      // Uma conta só é restaurada quando também existe o token da API.
      // Isso evita abrir telas privadas com uma sessão local que o Laravel rejeitaria.
      setIsGuest(guest);
      setUser(savedUser && token ? savedUser : null);
      if (savedUser && !token) await AsyncStorage.removeItem(USER_KEY);
    } catch (error) {
      setIsGuest(false);
      setUser(null);
    } finally {
      setIsLoadingSession(false);
    }
  }

  async function signIn(userData, token = null) {
    const normalizedUser = { ...userData, id: userData?.id ?? userData?.codUsuario, codUsuario: userData?.codUsuario ?? userData?.id };
    try {
      await AsyncStorage.setItem(USER_KEY, JSON.stringify(normalizedUser));
      if (token) await AsyncStorage.setItem(TOKEN_KEY, token);
      await AsyncStorage.removeItem(GUEST_KEY);
    } catch (error) { throw error; }
    setUser(normalizedUser);
    setIsGuest(false);
  }

  async function continueAsGuest() {
    try {
      await AsyncStorage.setItem(GUEST_KEY, 'true');
      await AsyncStorage.removeItem(USER_KEY);
      await AsyncStorage.removeItem(TOKEN_KEY);
    } catch (error) {}
    setIsGuest(true);
    setUser(null);
  }

  async function signOut() {
    try {
      await AsyncStorage.removeItem(GUEST_KEY);
      await AsyncStorage.removeItem(USER_KEY);
      await AsyncStorage.removeItem(TOKEN_KEY);
    } catch (error) {}
    setIsGuest(false);
    setUser(null);
  }

  const value = useMemo(
    () => ({ user, isGuest, isLoadingSession, signIn, continueAsGuest, signOut }),
    [user, isGuest, isLoadingSession]
  );

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth() {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuth precisa estar dentro de um AuthProvider');
  }
  return context;
}
