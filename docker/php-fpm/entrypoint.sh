#!/bin/bash

UID=${UID:-1000}
GID=${GID:-1000}

git config --global --add safe.directory /app

mkdir -p /app/storage/logs
mkdir -p /app/storage/framework/cache
mkdir -p /app/storage/framework/sessions
mkdir -p /app/storage/framework/views
mkdir -p /app/bootstrap/cache

touch /app/storage/logs/laravel.log

umask 0002

sudo chown -R www-data:www-data /app
sudo chmod -R 775 /app/storage
sudo chmod -R 775 /app/bootstrap/cache
sudo chmod 664 /app/storage/logs/laravel.log

sudo find /app -type d -exec chmod g+s {} \;

sudo find /app/storage -name "oauth-*.key" -exec chmod 600 {} \; 2>/dev/null || true
sudo find /app/storage -name "oauth-*.key" -exec chown www-data:www-data {} \; 2>/dev/null || true

export UID
export GID

exec "$@"
