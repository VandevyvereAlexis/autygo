<script setup lang="ts">
import { ref } from 'vue';
import router from '@/router';
import * as PasswordService from '@/services/PasswordService';
import FormError from '../components/FormError.vue';

const email = ref('');
const errors = ref<any>({});
const errorMessage = ref('');
const successMessage = ref('');
const isLoading = ref(false);

async function sendResetLink() {
    if (isLoading.value) return;
    
    // Reset messages
    errors.value = {};
    errorMessage.value = '';
    successMessage.value = '';
    isLoading.value = true;

    try {
        await PasswordService.sendResetLink(email.value);
        successMessage.value = 'Un lien de réinitialisation a été envoyé à votre adresse e-mail.';
        
        // Rediriger vers la page de connexion après 3 secondes
        setTimeout(() => {
            router.push('/login');
        }, 3000);
        
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

                <div class="card p-4 shadow-sm" style="width: 100%; max-width: 450px;">
                    <form @submit.prevent="sendResetLink">

                        <h2 class="form-title mb-3 text-center">Mot de passe oublié</h2>
                        <p class="text-muted text-center mb-4">
                            Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.
                        </p>
                            
                        <!-- Message de succès -->
                        <div v-if="successMessage" class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>{{ successMessage }}
                        </div>

                        <!-- Message d'erreur général -->
                        <div v-if="errorMessage" class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ errorMessage }}
                        </div>
                            
                        <div class="form-group mb-4">
                            <label for="Email" class="form-label">Adresse e-mail</label>
                            <input 
                                id="Email" 
                                type="email" 
                                class="form-control" 
                                v-model="email" 
                                :disabled="isLoading || !!successMessage"
                                aria-label="Adresse e-mail" 
                                placeholder="Votre adresse e-mail"
                                required
                            >
                            <FormError :errors="errors.email"/>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button 
                                type="submit" 
                                class="btn btn-primary py-2"
                                :disabled="isLoading || !!successMessage"
                            >
                                <span v-if="isLoading" class="spinner-border spinner-border-sm me-2" role="status"></span>
                                {{ isLoading ? 'Envoi en cours...' : 'Envoyer le lien de réinitialisation' }}
                            </button>
                        </div>

                    </form>

                    <!-- Retour à la connexion -->
                    <div class="text-center mt-3 pt-3 border-top">
                        <small class="text-muted">
                            Vous vous souvenez de votre mot de passe ? 
                            <router-link to="/login" class="text-decoration-none fw-semibold">
                                Retour à la connexion
                            </router-link>
                        </small>
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
</style>