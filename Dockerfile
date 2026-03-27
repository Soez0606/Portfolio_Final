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

# Ensure only mpm_prefork is enabled — prevents "More than one MPM loaded" crash
RUN a2dismod mpm_worker mpm_event 2>/dev/null || true
RUN a2enmod mpm_prefork

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

# Ajuste les permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copie et rend exécutable le script d'entrée qui configure le port au démarrage
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Commande de lancement
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]