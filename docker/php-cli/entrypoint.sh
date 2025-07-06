#!/bin/sh

if [ -n "$UID" ] && [ -n "$GID" ]; then
    groupmod -g "$GID" www-data
    usermod -u $UID -g "$GID" www-data
fi

chown -R www-data:www-data /var/www/html
chmod -R 775 /var/www/html
find /var/www/html -type f -exec chmod 664 {} \;
find /var/www/html -type d -exec chmod 775 {} \;

if [ $# -eq 0 ]; then
    exec su-exec www-data tail -f /dev/null
else
    exec su-exec www-data "$@"
fi
