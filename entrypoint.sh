#!/bin/bash
set -e

PORT="${PORT:-80}"

if [ "$PORT" != "80" ]; then
    sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
    sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

# On s'assure d'être dans le bon dossier
cd /var/www/html

# Sans APP_KEY, chaque requête renvoie une erreur 500 : on arrête tout de suite avec un message clair.
if [ -z "$APP_KEY" ]; then
    echo "ERREUR : la variable APP_KEY n'est pas définie sur Railway (php artisan key:generate --show)." >&2
    exit 1
fi

# SQLite : le fichier n'est pas versionné, on le crée s'il n'existe pas
# (DB_DATABASE peut pointer vers un volume Railway pour conserver les données entre déploiements).
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    DB_FILE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    mkdir -p "$(dirname "$DB_FILE")"
    touch "$DB_FILE"
    chown -R www-data:www-data "$(dirname "$DB_FILE")"
fi

# Tâches Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link --force || true
php artisan migrate --force

chown -R www-data:www-data storage bootstrap/cache

# On lance Apache (On utilise exec pour qu'il soit le processus principal)
exec apache2-foreground
