#!/bin/sh
# Set the port Apache listens on, defaulting to 8080 if PORT is not set
PORT="${PORT:-8080}"

# Update ports.conf and the default vhost with the correct port at runtime
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

exec apache2-foreground
