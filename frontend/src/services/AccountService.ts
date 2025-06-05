import axios from 'axios';
import { useUserStore } from '@/stores/User';

// Client Axios sans préfixe /api pour les routes d'authentification
const AxiosAuth = axios.create({
  baseURL: 'http://localhost:8000',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  withCredentials: true,
  withXSRFToken: true,
  xsrfCookieName: 'XSRF-TOKEN',
  xsrfHeaderName: 'X-XSRF-TOKEN'
});

// Intercepteur pour gérer les erreurs 401
AxiosAuth.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      // En cas d'erreur 401, nettoyer automatiquement le store
      const userStore = useUserStore();
      userStore.clearUser();
    }
    return Promise.reject(error);
  }
);

// Authentification de l'utilisateur - RETOURNE maintenant la réponse
export async function login(credentials: { email: string, password: string }) {
  try {
    await AxiosAuth.get('/sanctum/csrf-cookie');
    const response = await AxiosAuth.post('/login', credentials);
    
    // Mettre à jour le store ici aussi pour maintenir la compatibilité
    const userStore = useUserStore();
    userStore.setUser(response.data.user);
    
    // Retourner la réponse pour que LoginView puisse y accéder
    return response;
  } catch (error) {
    console.error('Erreur de connexion:', error);
    throw error;
  }
}

// Déconnexion de l'utilisateur
export async function logout(): Promise<void> {
  try {
    await AxiosAuth.post('/logout');
  } catch (error) {
    console.error('Erreur lors de la déconnexion:', error);
    // Continue même en cas d'erreur pour nettoyer le côté client
  } finally {
    const userStore = useUserStore();
    userStore.clearUser();
  }
}

// Récupère l'utilisateur connecté
export async function getUser(): Promise<any> {
  try {
    const res = await AxiosAuth.get('/me');
    if (res.data && res.data.user) {
      return res.data.user;
    }
    return null;
  } catch (error) {
    console.error('Erreur lors de la récupération de l\'utilisateur:', error);
    return null;
  }
}

// Vérifie si l'utilisateur est connecté
export function isLogged(): boolean {
  const userStore = useUserStore();
  return userStore.isLogged;
}