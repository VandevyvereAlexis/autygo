import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

interface ConnectedUser {
  id?: number;
  nom?: string;
  prenom?: string;
  pseudo?: string;
  email: string | null;
  role?: {
    id: number;
    nom: string;
  } | null;
  role_id?: number | null;
  image?: string | null;
}

export const useUserStore = defineStore('user', () => {
  const user = ref<ConnectedUser>({
    email: null,
    role: null
  });

  // Initialiser depuis localStorage au démarrage
  const initFromStorage = () => {
    const storedUser = localStorage.getItem('user');
    
    if (storedUser && storedUser !== 'null' && storedUser !== '') {
      try {
        const parsedUser = JSON.parse(storedUser);
        if (parsedUser.email && parsedUser.email !== 'null' && parsedUser.email !== '') {
          user.value = parsedUser;
        }
      } catch (error) {
        console.error('Erreur lors du parsing des données utilisateur:', error);
        localStorage.removeItem('user');
      }
    }
  };

  // Initialiser au démarrage
  initFromStorage();

  const isLogged = computed(() => {
    return !!(user.value.email && user.value.email !== 'null' && user.value.email !== '');
  });

  // Computed pour vérifier si l'utilisateur est admin
  const isAdmin = computed(() => {
    return user.value && user.value.role && user.value.role.nom === 'admin';
  });

  // Computed pour vérifier le rôle
  const hasRole = computed(() => (roleName: string) => {
    return user.value && user.value.role && user.value.role.nom === roleName;
  });

  function setUser(data: ConnectedUser) {
    user.value = {
      ...data,
      email: data.email
    };
    
    if (data.email && data.email !== '') {
      localStorage.setItem('user', JSON.stringify(user.value));
    }
  }

  function clearUser() {
    user.value = {
      email: null,
      role: null
    };
    localStorage.removeItem('user');
  }

  return {
    user,
    isLogged,
    isAdmin,
    hasRole,
    setUser,
    clearUser,
    initFromStorage
  };
});