#!/bin/bash
set -e

# Ensure correct permissions for Laravel directories
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/storage/app
chmod -R 775 /var/www/html/storage/framework
chmod -R 775 /var/www/html/storage/logs
chmod -R 775 /var/www/html/bootstrap/cache

# Fix ownership
chown -R laravel:laravel /var/www/html/storage
chown -R laravel:laravel /var/www/html/bootstrap/cache

# Switch to laravel user and start PHP-FPM
exec su -s /bin/bash -c 'exec php-fpm' laravel
