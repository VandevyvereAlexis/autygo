<script setup>
    import { useUserStore } from '@/stores/User'
    import { onMounted } from 'vue'
    import * as AccountService from '@/services/AccountService'
    import router from '@/router'

    // Importer le store utilisateur
    const userStore = useUserStore()

    // Vérifier si l'utilisateur est déjà authentifié au chargement
    onMounted(async () => {
        // Seulement si l'utilisateur semble connecté selon le store
        if (userStore.isLogged) {
            try {
                const user = await AccountService.getUser();
                if (user) {
                    userStore.setUser({
                        email: user.email,
                        role: user.role
                    });
                } else {
                    // Si l'API ne reconnaît pas l'utilisateur, nettoyer le store
                    userStore.clearUser();
                }
            } catch (error) {
                console.error('Erreur lors de la récupération de l\'utilisateur:', error);
                // En cas d'erreur 401, nettoyer le store
                if (error.response && error.response.status === 401) {
                    userStore.clearUser();
                }
            }
        }
    });

    // Fonction pour gérer la déconnexion
    async function handleLogout() {
        try {
            await AccountService.logout();
            router.push('/login');
        } catch (error) {
            console.error('Erreur lors de la déconnexion:', error);
            // Même en cas d'erreur, nettoyer le store local
            userStore.clearUser();
            router.push('/login');
        }
    }
</script>





<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">

            <router-link to='/' class="nav-link">Autygo</router-link>

            
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link to='/' class="nav-link">Accueil</router-link>
                </li>
            </ul>

            <!-- Navigation auth - VERSION MOBILE -->
            <div class="d-lg-none mt-2">
                <div v-if="userStore.isLogged" class="d-flex flex-column">
                    <span class="navbar-text mb-2">
                        <i class="bi bi-person-circle me-2"></i>{{ userStore.user.email }}
                    </span>
                    <button @click="handleLogout" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </button>
                </div>
                <router-link v-if="!userStore.isLogged" 
                            to='/login' 
                            class="btn btn-outline-primary">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Connexion
                </router-link>
            </div>
        </div>

        <!-- Navigation auth - VERSION DESKTOP -->
        <div class="d-none d-lg-flex align-items-center">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" 
                   href="#" 
                   role="button" 
                   data-bs-toggle="dropdown"
                   aria-expanded="false"
                   style="border: none;">
                    <i class="bi bi-person-circle fs-5"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-end">
                    <!-- Contenu pour utilisateur CONNECTÉ -->
                    <template v-if="userStore.isLogged">
                        <li class="dropdown-header">
                            <small class="text-muted">{{ userStore.user.email }}</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" @click.prevent="handleLogout">
                                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                            </a>
                        </li>
                    </template>

                    <!-- Contenu pour utilisateur NON CONNECTÉ -->
                    <template v-else>
                        <li>
                            <router-link to='/login' class="dropdown-item">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Connexion
                            </router-link>
                        </li>
                        <li>
                            <router-link to='/register' class="dropdown-item">
                                <i class="bi bi-person-plus me-2"></i>Inscription
                            </router-link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>

        </div>
    </nav>
</template>

<style>
/* Masquer la flèche dropdown */
.dropdown .nav-link::after {
    display: none;
}

/* Style hover pour l'icône utilisateur */
.dropdown .nav-link:hover {
    background-color: rgba(0,0,0,0.1);
    border-radius: 4px;
}
</style>