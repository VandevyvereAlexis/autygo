<script setup lang="ts">
    import { ref, onMounted } from 'vue';
    import router from '@/router';
    import * as AccountService from '../services/AccountService';
    import FormError from '../components/FormError.vue';
    import { useUserStore } from '@/stores/User';

    const userStore = useUserStore();

    const auth = ref({
        email: '',
        password: ''
    });

    const errors = ref<any>({});
    const errorMessage = ref('');

    onMounted(async () => {
        console.log('exec on mounted');
    });

    async function login() {
        // Reset des erreurs
        errors.value = {};
        errorMessage.value = '';

        try {
            // AccountService.login met déjà à jour le store automatiquement
            await AccountService.login(auth.value);
            
            console.log('Connexion réussie !');
            console.log('Utilisateur connecté:', userStore.user);
            console.log('Est admin:', userStore.isAdmin);
            console.log('Rôle:', userStore.user.role?.nom);
            
            router.push('/');
        } catch(error: any) {
            console.error('Erreur de connexion:', error);
            if (error.response && error.response.data) {
                if (error.response.data.errors) {
                    errors.value = error.response.data.errors;
                } else if (error.response.data.error) {
                    errorMessage.value = error.response.data.error;
                } else {
                    errorMessage.value = 'Erreur de connexion, veuillez réessayer.';
                }
            } else {
                errorMessage.value = 'Erreur de connexion, veuillez réessayer.';
            }
        }
    }
</script>

<template>
    
    <div class="container-fluid" style="height: 100vh; width: 100vw;">
        <div class="row min-vh-100">
            <div class="col d-flex justify-content-center align-items-center">

                <div class="card p-4 shadow-sm" style="width: 100%; max-width: 450px;">
                    <form @submit.prevent="login">

                        <h2 class="form-title mb-4 text-center">Connexion</h2>
                            
                        <!-- Afficher message d'erreur général -->
                        <div v-if="errorMessage" class="error-message">
                            {{ errorMessage }}
                        </div>
                            
                        <div class="form-group mb-3">
                            <label for="Email" class="form-label">Adresse email</label>
                            <input id="Email" type="text" class="form-control" v-model="auth.email" aria-label="Adresse email" placeholder="Adresse email">
                            <FormError :errors="errors.email"/>
                        </div>

                        <div class="form-group mb-4">
                            <label for="Password" class="form-label">Mot de passe</label>
                            <input id="Password" type="password" class="form-control" v-model="auth.password" aria-label="Mot de passe" placeholder="Mot de passe" />
                            <FormError :errors="errors.password"/>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2">Connexion</button>
                        </div>

                    </form>

                    <!-- Section liens utiles -->
                    <div class="mt-4">
                        <hr class="my-3">
                        
                        <!-- Lien mot de passe oublié -->
                        <div class="text-center mb-3">
                            <router-link to="/forgot-password" class="text-decoration-none text-muted">
                                <small>Mot de passe oublié ?</small>
                            </router-link>
                        </div>
                        
                        <!-- Lien inscription -->
                        <div class="text-center">
                            <small class="text-muted">
                                Pas encore de compte ? 
                                <router-link to="/register" class="text-decoration-none fw-semibold">
                                    Créez-en un
                                </router-link>
                            </small>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</template>

<style scoped>
.error-message {
    color: red;
    margin-bottom: 10px;
}
</style>