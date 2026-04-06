#!/bin/bash
set -e

PORT="${PORT:-80}"

if [ "$PORT" != "80" ]; then
    sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
    sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

# On s'assure d'être dans le bon dossier
cd /var/www/html

# Tâches Laravel (On garde ça, c'est rapide)
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# On lance Apache (On utilise exec pour qu'il soit le processus principal)
exec apache2-foreground