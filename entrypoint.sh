#!/bin/sh
set -e

# Set the port Apache listens on, defaulting to 8080 if PORT is not set
PORT="${PORT:-8080}"

# Update ports.conf and the default vhost with the correct port at runtime
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Ensure only mpm_event is active — guard against any image-level state where
# multiple MPM modules are still enabled, which would cause Apache to abort
# with "More than one MPM loaded".
a2dismod mpm_prefork mpm_worker 2>/dev/null || true
a2enmod mpm_event 2>/dev/null || true

# Validate the Apache configuration before attempting to start; if it is
# broken, print the error and exit with a non-zero code so Railway surfaces
# the real failure message rather than a cryptic process crash.
apache2ctl configtest

exec apache2-foreground
