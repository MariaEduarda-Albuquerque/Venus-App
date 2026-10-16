import { useCallback, useState } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';

const ONBOARDING_KEY = 'venus_onboarding_complete';

export function useOnboarding() {
  const [isSaving, setIsSaving] = useState(false);

  const finish = useCallback(async () => {
    setIsSaving(true);
    try {
      await AsyncStorage.setItem(ONBOARDING_KEY, 'true');
    } catch (error) {}
    setIsSaving(false);
  }, []);

  return { isSaving, finish };
}

export async function hasCompletedOnboarding() {
  try {
    const value = await AsyncStorage.getItem(ONBOARDING_KEY);
    return value === 'true';
  } catch (error) {
    return false;
  }
}
