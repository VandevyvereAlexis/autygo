<template>
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        
        <!-- Logo/Nom de l'app -->
        <div class="footer-brand">
          <h5 class="brand-name">Autygo</h5>
        </div>

        <!-- Liens rapides -->
        <div class="footer-links">
          <div class="link-group">
            <h6 class="link-title">Produit</h6>
            <ul class="link-list">
              <li><a href="#" class="footer-link">Fonctionnalités</a></li>
              <li><a href="#" class="footer-link">Tarifs</a></li>
              <li><a href="#" class="footer-link">Documentation</a></li>
            </ul>
          </div>

          <div class="link-group">
            <h6 class="link-title">Support</h6>
            <ul class="link-list">
              <li><a href="#" class="footer-link">Centre d'aide</a></li>
              <li><a href="#" class="footer-link">Contact</a></li>
              <li><a href="#" class="footer-link">Statut</a></li>
            </ul>
          </div>

          <div class="link-group">
            <h6 class="link-title">Légal</h6>
            <ul class="link-list">
              <li><a href="#" class="footer-link">Confidentialité</a></li>
              <li><a href="#" class="footer-link">Conditions</a></li>
              <li><a href="#" class="footer-link">Cookies</a></li>
            </ul>
          </div>
        </div>

        <!-- Réseaux sociaux -->
        <div class="footer-social">
          <h6 class="social-title">Suivez-nous</h6>
          <div class="social-links">
            <a href="#" class="social-link" aria-label="X (Twitter)">
              <i class="bi bi-twitter-x"></i>
            </a>
            <a href="#" class="social-link" aria-label="LinkedIn">
              <i class="bi bi-linkedin"></i>
            </a>
            <a href="#" class="social-link" aria-label="GitHub">
              <i class="bi bi-github"></i>
            </a>
            <a href="#" class="social-link" aria-label="Instagram">
              <i class="bi bi-instagram"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Copyright -->
      <div class="footer-bottom">
        <div class="copyright">
          <p>&copy; {{ currentYear }} Autygo. Tous droits réservés.</p>
        </div>
      </div>

    </div>
  </footer>
</template>

<script setup>
import { computed } from 'vue'

const currentYear = computed(() => new Date().getFullYear())
</script>

<style scoped>
.footer {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 3rem 0 1.5rem;
  margin-top: auto;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.footer-content {
  display: grid;
  grid-template-columns: 1fr 2fr 1fr;
  gap: 3rem;
  margin-bottom: 2rem;
}

/* Brand section */
.footer-brand {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}

.brand-name {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  background: linear-gradient(45deg, #ffffff, #e0e7ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.brand-tagline {
  color: rgba(255, 255, 255, 0.8);
  font-size: 0.9rem;
  margin: 0;
}

/* Links section */
.footer-links {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

.link-group {
  display: flex;
  flex-direction: column;
}

.link-title {
  font-size: 0.9rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: rgba(255, 255, 255, 0.9);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.link-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.link-list li {
  margin-bottom: 0.5rem;
}

.footer-link {
  color: rgba(255, 255, 255, 0.7);
  text-decoration: none;
  font-size: 0.9rem;
  transition: all 0.2s ease;
  position: relative;
}

.footer-link:hover {
  color: white;
  transform: translateX(3px);
}

/* Social section */
.footer-social {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}

.social-title {
  font-size: 0.9rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: rgba(255, 255, 255, 0.9);
}

.social-links {
  display: flex;
  gap: 1rem;
}

.social-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.social-link:hover {
  background: rgba(255, 255, 255, 0.2);
  color: white;
  transform: translateY(-2px);
}

.social-link i {
  font-size: 1.1rem;
}

/* Bottom section */
.footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 2rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.copyright p {
  margin: 0;
  color: rgba(255, 255, 255, 0.7);
  font-size: 0.85rem;
}

.made-with {
  color: rgba(255, 255, 255, 0.7);
  font-size: 0.85rem;
}

/* Responsive */
@media (max-width: 768px) {
  .footer {
    padding: 2rem 0 1rem;
  }

  .footer-content {
    grid-template-columns: 1fr;
    gap: 2rem;
    text-align: center;
  }

  .footer-links {
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
  }

  .footer-social {
    align-items: center;
  }

  .footer-bottom {
    flex-direction: column;
    gap: 1rem;
    text-align: center;
  }
}

@media (max-width: 480px) {
  .footer-links {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .container {
    padding: 0 1rem;
  }
}
</style>