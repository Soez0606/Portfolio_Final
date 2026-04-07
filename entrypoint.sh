#!/bin/bash
set -e

PORT="${PORT:-80}"

if [ "$PORT" != "80" ]; then
    sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
    sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

# Ensure only mpm_prefork is active
a2dismod mpm_worker mpm_event 2>/dev/null || true
a2enmod mpm_prefork

cd /var/www/html

# Install Node.js dependencies and build Vite assets
npm ci --prefer-offline
npm run build

# Run Laravel bootstrap tasks
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Start Apache
exec apache2-foreground
