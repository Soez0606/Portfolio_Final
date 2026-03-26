# Utilise une image PHP 8.4 avec Apache
FROM php:8.4-apache

# Installe les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring bcmath intl

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie le code source
COPY . /var/www/html

# Installe les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Configure les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Active le module Apache rewrite
RUN a2enmod rewrite