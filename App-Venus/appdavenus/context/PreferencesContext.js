import React, { createContext, useContext, useEffect, useMemo, useRef, useState } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useColorScheme } from 'react-native';
import api from '../api/api';
import { useAuth } from './AuthContext';

const PreferencesContext = createContext(null);
const LOCAL_KEY = 'venus_preferences';
const DEFAULTS = {
  temaUsuario: 'claro', idiomaUsuario: 'pt-BR', tamanhoFonteUsuario: 0.25,
  altoContrasteUsuario: false,
  preferenciasNotificacaoUsuario: { especialistas: true, consulta: true, diarioAtendimento: true, respostas: false, atividade: false, diarioSaude: true, campanhas: false },
  filtrosInteresseUsuario: ['Gravidez', 'Saúde mental', 'Higiene', 'Violência e acolhimento'],
  ocultarSensivelUsuario: false, visibilidadePerfilUsuario: 'anonima',
  mostrarBioUsuario: false, permitirApoioUsuario: true, anonimaPadraoUsuario: true,
};

export function PreferencesProvider({ children }) {
  const { user, signIn, isGuest } = useAuth();
  const systemScheme = useColorScheme();
  const [preferences, setPreferences] = useState(DEFAULTS);
  const [loadingPreferences, setLoadingPreferences] = useState(true);
  const queue = useRef(Promise.resolve());
  const userId = user?.codUsuario ?? user?.id;

  useEffect(() => {
    let active = true;
    async function load() {
      setLoadingPreferences(true);
      try {
        const local = await AsyncStorage.getItem(LOCAL_KEY);
        if (local && active) setPreferences({ ...DEFAULTS, ...JSON.parse(local) });
        if (userId && !isGuest) {
          const { data } = await api.get(`/usuario/${userId}`);
          const saved = data.usuario || data;
          if (active) setPreferences((current) => ({ ...DEFAULTS, ...current, ...saved,
            preferenciasNotificacaoUsuario: saved.preferenciasNotificacaoUsuario || current.preferenciasNotificacaoUsuario,
            filtrosInteresseUsuario: saved.filtrosInteresseUsuario || current.filtrosInteresseUsuario,
          }));
        }
      } catch (error) {
        // Mantém preferências locais se a API estiver temporariamente indisponível.
      } finally { if (active) setLoadingPreferences(false); }
    }
    load();
    return () => { active = false; };
  }, [userId, isGuest]);

  async function updatePreferences(patch) {
    const next = { ...preferences, ...patch };
    setPreferences(next);
    await AsyncStorage.setItem(LOCAL_KEY, JSON.stringify(next));
    if (userId && !isGuest) {
      // Serializa gravações rápidas para não salvar uma alteração antiga por último.
      queue.current = queue.current.catch(() => {}).then(async () => {
        const { data } = await api.put(`/usuario/${userId}/preferencias`, patch);
        const saved = data.preferencias;
        if (saved) {
          setPreferences((current) => ({ ...current, ...saved }));
          await AsyncStorage.setItem(LOCAL_KEY, JSON.stringify({ ...next, ...saved }));
          if (user) await signIn({ ...user, ...saved }, null);
        }
      });
      return queue.current;
    }
  }

  const highContrast = !!preferences.altoContrasteUsuario;
  const dark = preferences.temaUsuario === 'escuro' || (preferences.temaUsuario === 'sistema' && systemScheme === 'dark');
  const colors = useMemo(() => {
    if (dark) {
      return highContrast ? {
        background: '#0F0B10', card: '#1B1419', text: '#FFF8FA', muted: '#F7D8E0', border: '#7A4E5F',
        iconBg: '#2D1D27', selectedBg: '#4A2E3A', input: '#191216', wine: '#FFB1C6', white: '#F8EEF2',
      } : {
        background: '#19151A', card: '#282027', text: '#FFF2F6', muted: '#D0B8C2', border: '#503541',
        iconBg: '#3B2933', selectedBg: '#56303E', input: '#30252D', wine: '#FF9FBC', white: '#FFF5F8',
      };
    }

    return highContrast ? {
      background: '#FFFDFD', card: '#FFFFFF', text: '#180B12', muted: '#4E2A38', border: '#D9A0AF',
      iconBg: '#F9E1E8', selectedBg: '#F7DCE4', input: '#FFFFFF', wine: '#7C1125', white: '#FFFFFF',
    } : {
      background: '#FFF5F1', card: '#FFFFFF', text: '#3A1620', muted: '#8A6670', border: '#F1D3DA',
      iconBg: '#FCE3E8', selectedBg: '#FDE4EA', input: '#FFFFFF', wine: '#9E182B', white: '#FFFFFF',
    };
  }, [dark, highContrast]);

  const savedFontScale = Number(preferences.tamanhoFonteUsuario ?? 0.25);
  const normalizedFontScale = Number.isFinite(savedFontScale)
    ? Math.min(1, Math.max(0, savedFontScale))
    : 0.25;
  const fontScale = 0.9 + normalizedFontScale * 0.25;
  const value = useMemo(() => ({ preferences, updatePreferences, loadingPreferences, dark, colors, highContrast, fontScale }), [preferences, loadingPreferences, dark, colors, highContrast, fontScale]);
  return <PreferencesContext.Provider value={value}>{children}</PreferencesContext.Provider>;
}

export function usePreferences() {
  const value = useContext(PreferencesContext);
  if (!value) throw new Error('usePreferences precisa estar dentro de PreferencesProvider');
  return value;
}
