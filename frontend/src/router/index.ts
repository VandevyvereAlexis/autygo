import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import NotFoundView from '@/views/NotFoundView.vue'
import RegisterView from '@/views/RegisterView.vue'
import ForgotPasswordView from '@/views/ForgotPasswordView.vue'
import ResetPasswordView from '@/views/ResetPasswordView.vue'
import { useUserStore } from '@/stores/User'


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView,
            // meta: { requiresAuth: true }
        },
        {
            path: '/about',
            name: 'about',
            component: () => import('../views/AboutView.vue'),
            meta: { requiresAuth: true }
        },
        {
            // Routes pour l'authentification
            path: '/login',
            name: 'login',
            component: LoginView,
            meta: { requiresGuest: true }
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterView,
            meta: { requiresGuest: true }
        },
        {
            path: '/forgot-password',
            name: 'forgot-password',
            component: ForgotPasswordView,
            meta: { requiresGuest: true }
        },
        {
            path: '/reset-password',
            name: 'reset-password',
            component: ResetPasswordView,
            meta: { requiresGuest: true }
        },
        {
            // Route pour la page 404
            path: '/:pathMatch(.*)*',
            name: 'not-found',
            component: NotFoundView
        },
    ],
})


// Gestion des routes protégées
router.beforeEach((to, from, next) => {
    const userStore = useUserStore()

    // Si la route nécessite une authentification
    if (to.meta.requiresAuth && !userStore.isLogged) {
        next('/login')
        return
    }

    // Si l'utilisateur est connecté et essaie d'accéder à login/register
    if (to.meta.requiresGuest && userStore.isLogged) {
        next('/')
        return
    }

    // Si la route est accessible, continuez
    next()
})

export default router