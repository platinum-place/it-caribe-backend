#!/bin/bash
set -e

# Ensure Laravel directories exist and have correct permissions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/app
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/bootstrap/cache

# Set permissions
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Fix ownership
chown -R laravel:laravel /var/www/html/storage
chown -R laravel:laravel /var/www/html/bootstrap/cache

# Handle Laravel Passport keys if they exist
if [ -f /var/www/html/storage/oauth-private.key ]; then
    chmod 600 /var/www/html/storage/oauth-private.key
    chown laravel:laravel /var/www/html/storage/oauth-private.key
fi

if [ -f /var/www/html/storage/oauth-public.key ]; then
    chmod 600 /var/www/html/storage/oauth-public.key
    chown laravel:laravel /var/www/html/storage/oauth-public.key
fi

# Start PHP-FPM as root (it will drop privileges automatically)
exec php-fpm
