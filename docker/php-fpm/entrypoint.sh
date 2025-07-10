#!/bin/bash
set -e

# Ensure Laravel directories exist and have correct permissions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/app
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/bootstrap/cache

chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Create PHP error log file and set permissions
touch /var/www/html/storage/logs/php_errors.log
chmod 664 /var/www/html/storage/logs/php_errors.log

# Ensure Laravel Passport storage directories exist with proper permissions
mkdir -p /var/www/html/storage/oauth-private.key
mkdir -p /var/www/html/storage/oauth-public.key

# Set strict permissions for Laravel Passport tokens
find /var/www/html/storage/ -name "oauth-*.key" -type f -exec chmod 600 {} \;

# Fix ownership
chown -R laravel:laravel /var/www/html/storage
chown -R laravel:laravel /var/www/html/bootstrap/cache

# Switch to laravel user and start PHP-FPM
exec su -s /bin/bash -c 'exec php-fpm' laravel
