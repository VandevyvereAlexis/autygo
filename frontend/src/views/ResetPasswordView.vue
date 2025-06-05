<script setup lang="ts">
    import { ref, onMounted } from 'vue';
    import { useRoute } from 'vue-router';
    import router from '@/router';
    import * as PasswordService from '@/services/PasswordService';
    import FormError from '../components/FormError.vue';

    // Import useRoute pour accéder aux paramètres de l'URL
    const route = useRoute();

    // Données pour la réinitialisation du mot de passe
    const resetData = ref({
        token: '',
        email: '',
        password: '',
        password_confirmation: ''
    });

    // Références pour les messages d'erreur et de succès
    const errors = ref<any>({});
    const errorMessage = ref('');
    const successMessage = ref('');
    const isLoading = ref(false);

    // Exécuter lors du montage du composant
    onMounted(() => {
        // Récupérer le token et l'email depuis l'URL
        resetData.value.token = route.query.token as string || '';
        resetData.value.email = route.query.email as string || '';
        
        // Vérifier que nous avons les paramètres nécessaires
        if (!resetData.value.token || !resetData.value.email) {
            errorMessage.value = 'Lien de réinitialisation invalide ou expiré.';
        }
    });

    // Fonction pour réinitialiser le mot de passe
    async function resetPassword() {
        if (isLoading.value) return;

        // Réinitialiser les messages
        errors.value = {};
        errorMessage.value = '';
        successMessage.value = '';
        isLoading.value = true;

        // Vérifier que le token et l'email sont présents
        try {
            // Si le token ou l'email est manquant, afficher un message d'erreur
            await PasswordService.resetPassword(resetData.value);
            successMessage.value = 'Votre mot de passe a été réinitialisé avec succès !';
            
            // Rediriger vers la page de connexion après 2 secondes
            setTimeout(() => {
                router.push('/login');
            }, 2000);
             
        // Gérer les erreurs
        } catch (error: any) {
            console.error('Erreur:', error);
            if (error.response && error.response.data) {
                if (error.response.data.errors) {
                    errors.value = error.response.data.errors;
                } else if (error.response.data.error) {
                    errorMessage.value = error.response.data.error;
                } else {
                    errorMessage.value = 'Une erreur est survenue, veuillez réessayer.';
                }
            } else {
                errorMessage.value = 'Une erreur est survenue, veuillez réessayer.';
            }
        } finally {
            isLoading.value = false;
        }
    }
</script>





<template>
    <div class="container-fluid" style="height: 100vh; width: 100vw;">
        <div class="row min-vh-100">
            <div class="col d-flex justify-content-center align-items-center">

                <!-- Carte de réinitialisation du mot de passe -->
                <div class="card p-4 shadow-sm" style="width: 100%; max-width: 450px;">
                    <form @submit.prevent="resetPassword">

                        <h2 class="form-title mb-3 text-center">Nouveau mot de passe</h2>
                        <p class="text-muted text-center mb-4">Choisissez un nouveau mot de passe sécurisé pour votre compte.</p>
                            
                        <!-- Message de succès -->
                        <div v-if="successMessage" class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>{{ successMessage }}
                        </div>

                        <!-- Message d'erreur général -->
                        <div v-if="errorMessage" class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ errorMessage }}
                        </div>

                        <!-- Email (lecture seule) -->
                        <div class="form-group mb-3">
                            <label for="Email" class="form-label">Adresse e-mail</label>
                            <input 
                                id="Email" 
                                type="email" 
                                class="form-control" 
                                v-model="resetData.email" 
                                readonly
                                aria-label="Adresse e-mail"
                            >
                        </div>
                            
                        <!-- Nouveau mot de passe -->
                        <div class="form-group mb-3">
                            <label for="Password" class="form-label">Nouveau mot de passe</label>
                            <input 
                                id="Password" 
                                type="password" 
                                class="form-control" 
                                v-model="resetData.password" 
                                :disabled="isLoading || !!successMessage"
                                aria-label="Nouveau mot de passe" 
                                placeholder="Nouveau mot de passe"
                                required
                            >
                            <FormError :errors="errors.password"/>
                            <small class="form-text text-muted">Le mot de passe doit contenir au moins 8 caractères avec majuscules, minuscules, chiffres et symboles.</small>
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="form-group mb-4">
                            <label for="PasswordConfirmation" class="form-label">Confirmer le mot de passe</label>
                            <input 
                                id="PasswordConfirmation" 
                                type="password" 
                                class="form-control" 
                                v-model="resetData.password_confirmation" 
                                :disabled="isLoading || !!successMessage"
                                aria-label="Confirmer le mot de passe" 
                                placeholder="Confirmer le mot de passe"
                                required
                            >
                            <FormError :errors="errors.password_confirmation"/>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary py-2" :disabled="isLoading || !!successMessage || !resetData.token">
                                <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                {{ isLoading ? 'Mise à jour...' : 'Réinitialiser le mot de passe' }}
                            </button>
                        </div>

                    </form>

                    <!-- Retour à la connexion -->
                    <div class="text-center mt-3 pt-3 border-top">
                        <small class="text-muted"><router-link to="/login" class="text-decoration-none fw-semibold">Retour à la connexion</router-link></small>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>





<style scoped>
    .alert {
        border-radius: 8px;
        border: none;
    }

    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
    }

    .form-text {
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }
</style>