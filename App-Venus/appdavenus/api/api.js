import axios from "axios";
import AsyncStorage from "@react-native-async-storage/async-storage";

// Android emulator: use http://10.0.2.2:8000/api
// Physical phone: use your computer's LAN IP, e.g. http://192.168.0.135:8000/api
// Web/desktop: http://127.0.0.1:8000/api
export const API_URL = process.env.EXPO_PUBLIC_API_URL || "http://192.168.0.135:8000/api";
export const TOKEN_KEY = "venus_api_token";

const api = axios.create({
  baseURL: API_URL,
  headers: { Accept: "application/json", "Content-Type": "application/json" },
  timeout: 15000,
});

api.interceptors.request.use(async (config) => {
  const token = await AsyncStorage.getItem(TOKEN_KEY);
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});

export default api;
