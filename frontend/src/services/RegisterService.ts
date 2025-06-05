import axios from 'axios';
import { useUserStore } from '@/stores/User';

// Client Axios pour l'inscription - EXACTEMENT comme AccountService mais pour /api
const AxiosRegister = axios.create({
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

interface RegisterData {
  pseudo: string;
  nom: string;
  prenom: string;
  email: string;
  password: string;
  password_confirmation: string;
  image?: File | null;
}

// Inscription de l'utilisateur
export async function register(userData: RegisterData): Promise<void> {
  try {
    // Récupération du token CSRF exactement comme AccountService
    await AxiosRegister.get('/sanctum/csrf-cookie');

    // Création du FormData pour gérer l'upload d'image
    const formData = new FormData();
    formData.append('pseudo', userData.pseudo);
    formData.append('nom', userData.nom);
    formData.append('prenom', userData.prenom);
    formData.append('email', userData.email);
    formData.append('password', userData.password);
    formData.append('password_confirmation', userData.password_confirmation);
    
    if (userData.image) {
      formData.append('image', userData.image);
    }

    // Appel à /api/register (pas /register comme login)
    const res = await AxiosRegister.post('/api/register', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });

    const userStore = useUserStore();

    // Mise à jour du store utilisateur exactement comme AccountService
    userStore.setUser({
      email: res.data.user.email,
      role: res.data.user.role
    });

  } catch (error) {
    console.error('Erreur d\'inscription:', error);
    throw error;
  }
}