#!/bin/bash

sleep 1

if [ -d "storage" ]; then
    chown -R www-data:www-data storage
    chmod -R 775 storage
fi

if [ -d "bootstrap/cache" ]; then
    chown -R www-data:www-data bootstrap/cache
    chmod -R 775 bootstrap/cache
    chmod 600 ./storage/oauth-public.key
    chmod 600 ./storage/oauth-private.key
fi

chown www-data:www-data /var/www/html/ZCRMClientLibrary.log 2>/dev/null || true
chown www-data:www-data /var/www/html/zcrm_oauthtokens.txt 2>/dev/null || true

chmod 777 /var/www/html/ZCRMClientLibrary.log 2>/dev/null || true
chmod 77 /var/www/html/zcrm_oauthtokens.txt 2>/dev/null || true

exec "$@"
