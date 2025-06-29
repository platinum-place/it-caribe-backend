#!/bin/bash
set -e

USER_ID=${UID:-1000}
GROUP_ID=${GID:-1000}

# Crear directorios necesarios si no existen
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p bootstrap/cache

# Establecer permisos correctos
chown -R "$USER_ID":"$GROUP_ID" /var/www/html

chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# Crear y configurar archivo de log de Zoho si no existe
if [ ! -f ZCRMClientLibrary.log ]; then
    touch ZCRMClientLibrary.log
fi
chmod 666 ZCRMClientLibrary.log
chown "$USER_ID":"$GROUP_ID" ZCRMClientLibrary.log

# Ejecutar comando como el usuario correcto
exec gosu "$USER_ID":"$GROUP_ID" "$@"
