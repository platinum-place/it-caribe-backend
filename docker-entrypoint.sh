#!/bin/bash
set -e

if [ -d /app/storage ]; then
    chmod -R 775 /app/storage
fi
if [ -d /app/bootstrap/cache ]; then
    chmod -R 775 /app/bootstrap/cache
fi

exec "$@"
