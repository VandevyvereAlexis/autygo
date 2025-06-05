import axios from 'axios';

// Client Axios pour les requêtes de mot de passe
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

// Demander un lien de réinitialisation
export async function sendResetLink(email: string): Promise<void> {
  try {
    await AxiosAuth.get('/sanctum/csrf-cookie');
    await AxiosAuth.post('/password/email', { email });
  } catch (error) {
    console.error('Erreur lors de l\'envoi du lien de réinitialisation:', error);
    throw error;
  }
}

// Réinitialiser le mot de passe
export async function resetPassword(data: {
  token: string;
  email: string;
  password: string;
  password_confirmation: string;
}): Promise<void> {
  try {
    await AxiosAuth.get('/sanctum/csrf-cookie');
    await AxiosAuth.post('/password/reset', data);
  } catch (error) {
    console.error('Erreur lors de la réinitialisation du mot de passe:', error);
    throw error;
  }
}