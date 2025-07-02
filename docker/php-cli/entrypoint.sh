#!/bin/bash
set -e

UID=${UID:-1000}
GID=${GID:-1000}

mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/app/public
mkdir -p bootstrap/cache

chown -R "$UID":"$GID" /var/www/html

chmod -R 775 storage/
chmod -R 775 storage/logs/
chmod -R 775 storage/framework/cache/
chmod -R 775 storage/framework/sessions/
chmod -R 775 storage/framework/views/
chmod -R 775 storage/app/public/
chmod -R 775 bootstrap/cache/

if [ ! -f ZCRMClientLibrary.log ]; then
    touch ZCRMClientLibrary.log
fi
chmod 666 ZCRMClientLibrary.log
chown "$UID":"$GID" ZCRMClientLibrary.log

umask 002

exec gosu "$UID":"$GID" "$@"
