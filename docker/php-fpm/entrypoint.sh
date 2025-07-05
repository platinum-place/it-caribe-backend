#!/bin/sh

if [ -n "$UID" ] && [ -n "$GID" ]; then
    groupmod -g "$GID" www-data
    usermod -u $UID -g "$GID" www-data
fi

chown -R www-data:www-data /var/www/html

exec "$@"
