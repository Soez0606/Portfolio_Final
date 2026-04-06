FROM php:8.4-apache

# Install system dependencies and Node.js (LTS via NodeSource)
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
    libsqlite3-dev \
    && curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (Ajout de pdo_sqlite pour ta DB)
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    zip \
    mbstring \
    bcmath \
    intl

# Enable Apache rewrite module and fix MPM conflicts
RUN a2enmod rewrite \
    && a2dismod mpm_worker mpm_event \
    && a2enmod mpm_prefork

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY mon-Portfolio/ .

# --- LES ÉTAPES CRUCIALES POUR VITE ---
# 1. Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 2. Installer les dépendances JS et COMPILER les assets (Règle l'erreur Manifest)
RUN npm install
RUN npm run build
# --------------------------------------

# Configure Apache DocumentRoot to point to /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
    /etc/apache2/apache2.conf || true \
    && echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
    </Directory>' >> /etc/apache2/sites-available/000-default.conf

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copy and configure entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]