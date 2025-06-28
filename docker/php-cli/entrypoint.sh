#!/bin/bash
set -e

# Obtener UID y GID de las variables de entorno
USER_ID=${UID:-1000}
GROUP_ID=${GID:-1000}

# Crear grupo si no existe
if ! getent group $GROUP_ID >/dev/null; then
    groupadd -g $GROUP_ID appgroup
fi

# Crear usuario si no existe
if ! getent passwd $USER_ID >/dev/null; then
    useradd -u $USER_ID -g $GROUP_ID -m -s /bin/bash appuser
fi

# Crear directorios necesarios
mkdir -p storage/logs
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p bootstrap/cache

# Cambiar propietario de todo el proyecto
chown -R $USER_ID:$GROUP_ID /var/www/html

# Dar permisos de escritura
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# Crear archivo de log si no existe
touch ZCRMClientLibrary.log
chmod 666 ZCRMClientLibrary.log
chown $USER_ID:$GROUP_ID ZCRMClientLibrary.log

# Ejecutar como el usuario correcto
exec gosu $USER_ID:$GROUP_ID "$@"
