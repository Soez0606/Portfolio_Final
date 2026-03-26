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

# Active le module Apache rewrite (important pour les routes Laravel)
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie le code source dans le conteneur
COPY . /var/www/html

# Définit le dossier de travail
WORKDIR /var/www/html

# Installe les dépendances PHP (ignore les scripts pour éviter les erreurs de DB au build)
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Configure le DocumentRoot pour pointer vers /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# CORRECTION : Configure Apache pour écouter sur le port variable de Railway ($PORT)
# Note : Railway utilise souvent le port 8080 par défaut si non spécifié, mais $PORT est plus sûr.
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Ajuste les permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Commande de lancement
CMD ["apache2-foreground"]