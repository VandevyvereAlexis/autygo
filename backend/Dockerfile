FROM php:8.3-apache

WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip mysqli pdo_mysql

COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.* ./
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress || true

COPY . .

RUN composer install --prefer-dist --no-interaction --no-dev

RUN chown -R www-data:www-data /var/www/app/storage \
 && chmod -R 775 /var/www/app/storage