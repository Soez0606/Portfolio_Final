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
    libicu-dev \
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

# Change le DocumentRoot vers /public pour Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure Apache pour écouter sur le port fourni par Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/0000-default.conf /etc/apache2/ports.conf

# Active le module Apache rewrite
RUN a2enmod rewrite 