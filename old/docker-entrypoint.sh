#!/bin/bash
set -e

chmod -R 775 /app/storage
chmod -R 775 /app/bootstrap/cache

exec "$@"
