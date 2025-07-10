#!/bin/bash
set -e

# Ensure correct permissions for Laravel directories
chmod -R 600 /var/www/html/storage
chmod -R 775 /var/www/html/storage/app
chmod -R 775 /var/www/html/storage/framework
chmod -R 775 /var/www/html/storage/logs
chmod -R 775 /var/www/html/bootstrap/cache

# Start PHP-FPM
exec php-fpm
