import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

interface ConnectedUser {
  email: string | null;
  role: string | null;
}

export const useUserStore = defineStore('user', () => {
  const user = ref<ConnectedUser>({
    email: null,
    role: null
  });

  // Initialiser depuis localStorage au démarrage
  const initFromStorage = () => {
    const storedEmail = localStorage.getItem('email');
    const storedRole = localStorage.getItem('role');
    
    if (storedEmail && storedEmail !== 'null' && storedEmail !== '') {
      user.value.email = storedEmail;
      user.value.role = storedRole;
    }
  };

  // Initialiser au démarrage
  initFromStorage();

  const isLogged = computed(() => {
    return !!(user.value.email && user.value.email !== 'null' && user.value.email !== '');
  });

  function setUser(data: ConnectedUser) {
    user.value.email = data.email;
    user.value.role = data.role;
    
    if (data.email && data.email !== '') {
      localStorage.setItem('email', String(data.email));
      localStorage.setItem('role', String(data.role));
    }
  }

  function clearUser() {
    user.value.email = null;
    user.value.role = null;
    localStorage.removeItem('email');
    localStorage.removeItem('role');
  }

  return {
    user,
    isLogged,
    setUser,
    clearUser,
    initFromStorage
  };
});