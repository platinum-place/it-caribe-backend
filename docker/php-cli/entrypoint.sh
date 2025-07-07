#!/bin/bash
set -e

# Get the current UID and GID from environment variables
USER_ID=${UID:-1000}
GROUP_ID=${GID:-1000}

# Set proper ownership of the Laravel project files
chown -R "$USER_ID":"$GROUP_ID" /var/www/html

# Make sure storage and bootstrap/cache directories are writable
if [ -d "/var/www/html/storage" ]; then
    chmod -R 775 /var/www/html/storage
fi

if [ -d "/var/www/html/bootstrap/cache" ]; then
    chmod -R 775 /var/www/html/bootstrap/cache
fi

# Execute the command with the www-data user
exec gosu www-data "$@"
