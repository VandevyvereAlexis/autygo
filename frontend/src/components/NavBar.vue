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
                
                <!-- Section Admin - Visible uniquement pour les admins -->
                <li v-if="userStore.isAdmin" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle admin-link" 
                       href="#" 
                       role="button" 
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-gear-fill me-1"></i>Back Office
                    </a>
                    <ul class="dropdown-menu">
                        <li><h6 class="dropdown-header">Gestion</h6></li>
                        <li><router-link to="/admin/users" class="dropdown-item">
                            <i class="bi bi-people me-2"></i>Utilisateurs
                        </router-link></li>
                        <li><router-link to="/admin/dashboard" class="dropdown-item">
                            <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
                        </router-link></li>
                        <li><router-link to="/admin/roles" class="dropdown-item">
                            <i class="bi bi-person-badge me-2"></i>Rôles
                        </router-link></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><router-link to="/admin/settings" class="dropdown-item">
                            <i class="bi bi-sliders me-2"></i>Paramètres
                        </router-link></li>
                    </ul>
                </li>
            </ul>

            <!-- Navigation auth - VERSION MOBILE -->
            <div class="d-lg-none mt-2">
                <div v-if="userStore.isLogged" class="d-flex flex-column">
                    <span class="navbar-text mb-2">
                        <i class="bi bi-person-circle me-2"></i>{{ userStore.user.email }}
                        <span v-if="userStore.isAdmin" class="badge bg-danger ms-2">Admin</span>
                    </span>
                    
                    <!-- Menu admin mobile -->
                    <div v-if="userStore.isAdmin" class="admin-mobile-menu mb-3">
                        <h6 class="text-muted mb-2">Back Office</h6>
                        <router-link to="/admin/dashboard" class="btn btn-outline-secondary btn-sm me-2 mb-1">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </router-link>
                        <router-link to="/admin/users" class="btn btn-outline-secondary btn-sm me-2 mb-1">
                            <i class="bi bi-people me-1"></i>Utilisateurs
                        </router-link>
                    </div>
                    
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
                    <span v-if="userStore.isAdmin" class="badge bg-danger ms-1">Admin</span>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-end">
                    <!-- Contenu pour utilisateur CONNECTÉ -->
                    <template v-if="userStore.isLogged">
                        <li class="dropdown-header">
                            <small class="text-muted">{{ userStore.user.email }}</small>
                            <br>
                            <span v-if="userStore.user.role" class="badge bg-secondary">{{ userStore.user.role.nom }}</span>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Paramètres</a></li>
                        
                        <!-- Accès rapide admin -->
                        <template v-if="userStore.isAdmin">
                            <li><hr class="dropdown-divider"></li>
                            <li class="dropdown-header">Administration</li>
                            <li><router-link to="/admin/dashboard" class="dropdown-item">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                            </router-link></li>
                        </template>
                        
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

<style scoped>
/* Masquer la flèche dropdown */
.dropdown .nav-link::after {
    display: none;
}

/* Style hover pour l'icône utilisateur */
.dropdown .nav-link:hover {
    background-color: rgba(0,0,0,0.1);
    border-radius: 4px;
}

/* Style spécial pour le lien admin */
.admin-link {
    color: #dc3545 !important;
    font-weight: 600;
}

.admin-link:hover {
    background-color: rgba(220, 53, 69, 0.1);
    border-radius: 4px;
}

/* Badge admin responsive */
.badge {
    font-size: 0.65rem;
}

/* Menu admin mobile */
.admin-mobile-menu {
    padding: 0.5rem;
    background-color: rgba(220, 53, 69, 0.05);
    border-radius: 6px;
    border: 1px solid rgba(220, 53, 69, 0.2);
}

/* Animation pour le badge admin */
@keyframes pulse-admin {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.badge.bg-danger {
    animation: pulse-admin 2s infinite;
}
</style>