#!/bin/sh
set -e

# Set the port Apache listens on, defaulting to 8080 if PORT is not set
PORT="${PORT:-8080}"

# Update ports.conf and the default vhost with the correct port at runtime
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Ensure only mpm_prefork is active — PHP is compiled non-threadsafe and cannot
# run under a threaded MPM. Disable mpm_worker and mpm_event at runtime as a
# safeguard, then explicitly enable mpm_prefork.
a2dismod mpm_worker mpm_event 2>/dev/null || true
a2enmod mpm_prefork 2>/dev/null || true

# Validate the Apache configuration before attempting to start; if it is
# broken, print the error and exit with a non-zero code so Railway surfaces
# the real failure message rather than a cryptic process crash.
apache2ctl configtest

exec apache2-foreground
