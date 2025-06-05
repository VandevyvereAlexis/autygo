<script setup lang="ts">
    import { ref, onMounted } from 'vue';
    import router from '@/router';
    import * as RegisterService from '../services/RegisterService';
    import FormError from '../components/FormError.vue';

    // Importer le service d'inscription
    const form = ref({
        pseudo: '',
        nom: '',
        prenom: '',
        email: '',
        password: '',
        password_confirmation: '',
        image: null as File | null
    });

    // Références pour les messages d'erreur et de succès
    const errors = ref<any>({});
    const errorMessage = ref('');
    const successMessage = ref('');
    const imagePreview = ref<string | null>(null);

    // Exécuter lors du montage du composant
    onMounted(async () => {
        console.log('Register view mounted');
    });

    // Gestion du changement d'image
    function handleImageChange(event: Event) {
        const target = event.target as HTMLInputElement;
        const file = target.files?.[0] || null;
        form.value.image = file;

        // Aperçu de l'image
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.value = e.target?.result as string;
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.value = null;
        }
    }

    async function register() {
        try {
            // Reset des erreurs - EXACTEMENT comme LoginView
            errors.value = {};
            errorMessage.value = '';

            await RegisterService.register(form.value);

            console.log('Inscription réussie !');
            successMessage.value = 'Inscription réussie ! Un email de vérification a été envoyé.';

            // Redirection après succès - EXACTEMENT comme LoginView
            setTimeout(() => {
                router.push('/');
            }, 2000);

        } catch (error: any) {
            // Gestion d'erreurs EXACTEMENT comme LoginView
            console.error('Erreur d\'inscription:', error);
            if (error.response && error.response.data) {
                if (error.response.data.errors) {
                    errors.value = error.response.data.errors;
                } else if (error.response.data.error) {
                    errorMessage.value = error.response.data.error;
                } else {
                    errorMessage.value = 'Erreur d\'inscription, veuillez réessayer.';
                }
            } else {
                errorMessage.value = 'Erreur d\'inscription, veuillez réessayer.';
            }
        }
    }
</script>





<template>
    
    <div class="container-fluid" style="height: 100vh; width: 100vw;">
        <div class="row min-vh-100">
            <div class="col d-flex justify-content-center align-items-center">

                <div class="card p-4 shadow-sm" style="width: 100%; max-width: 600px;">
                    <form @submit.prevent="register">

                        <h2 class="form-title mb-4 text-center">Inscription</h2>
                            
                        <!-- Afficher message d'erreur général -->
                        <div v-if="errorMessage" class="error-message">
                            {{ errorMessage }}
                        </div>

                        <!-- Message de succès -->
                        <div v-if="successMessage" class="error-message" style="color: green;">
                            {{ successMessage }}
                        </div>
                            
                        <!-- Pseudo -->
                        <div class="form-group mb-3">
                            <label for="pseudo" class="form-label">Pseudo *</label>
                            <input 
                                id="pseudo"
                                type="text" 
                                class="form-control" 
                                v-model="form.pseudo"
                                aria-label="Pseudo" 
                                placeholder="Votre pseudo"
                            />
                            <FormError :errors="errors.pseudo"/>
                        </div>

                        <!-- Nom et Prénom -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nom" class="form-label">Nom *</label>
                                    <input 
                                        id="nom"
                                        type="text" 
                                        class="form-control" 
                                        v-model="form.nom"
                                        aria-label="Nom" 
                                        placeholder="Votre nom"
                                    />
                                    <FormError :errors="errors.nom"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="prenom" class="form-label">Prénom *</label>
                                    <input 
                                        id="prenom"
                                        type="text" 
                                        class="form-control" 
                                        v-model="form.prenom"
                                        aria-label="Prénom" 
                                        placeholder="Votre prénom"
                                    />
                                    <FormError :errors="errors.prenom"/>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-3">
                            <label for="Email" class="form-label">Adresse email</label>
                            <input 
                                id="Email" 
                                type="text" 
                                class="form-control" 
                                v-model="form.email" 
                                aria-label="Adresse email" 
                                placeholder="Adresse email"
                            />
                            <FormError :errors="errors.email"/>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group mb-3">
                            <label for="Password" class="form-label">Mot de passe</label>
                            <input 
                                id="Password" 
                                type="password" 
                                class="form-control" 
                                v-model="form.password" 
                                aria-label="Mot de passe" 
                                placeholder="Mot de passe" 
                            />
                            <FormError :errors="errors.password"/>
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                class="form-control" 
                                v-model="form.password_confirmation" 
                                aria-label="Confirmer le mot de passe" 
                                placeholder="Confirmez votre mot de passe" 
                            />
                            <FormError :errors="errors.password_confirmation"/>
                        </div>

                        <!-- Image de profil -->
                        <div class="form-group mb-4">
                            <label for="image" class="form-label">Photo de profil</label>
                            <input 
                                id="image" 
                                type="file" 
                                class="form-control" 
                                accept="image/jpeg,image/jpg,image/png,image/webp"
                                @change="handleImageChange"
                            />
                            <FormError :errors="errors.image"/>
                        </div>

                        <!-- Aperçu de l'image -->
                        <div v-if="imagePreview" class="text-center mb-4">
                            <img :src="imagePreview" alt="Aperçu" class="rounded-avatar">
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2">S'inscrire</button>
                        </div>

                    </form>

                    <!-- Section liens utiles -->
                    <div class="mt-4">
                        <hr class="my-3">
                        
                        <!-- Lien inscription -->
                        <div class="text-center">
                            <small class="text-muted">
                                Déjà un compte ? 
                                <router-link to="/login" class="text-decoration-none fw-semibold">
                                    Se connecter
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

.rounded-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e9ecef;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>