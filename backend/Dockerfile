FROM php:8.3-apache

WORKDIR /var/www/app

# Install des extensions nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip mysqli pdo_mysql

# Configuration d'Apache
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Variables d'environnement
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ajout de l'argument MODE pour choisir l'environnement (test ou prod)
ARG MODE=test
COPY .env.${MODE} .env

# Installation des dépendances PHP
COPY composer.* ./
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress || true

# Copie du code source
COPY . .

# Réinstallation finale après copie de tous les fichiers
RUN composer install --prefer-dist --no-interaction --no-dev

# Permissions pour Laravel
RUN chown -R www-data:www-data /var/www/app/storage \
 && chmod -R 775 /var/www/app/storage