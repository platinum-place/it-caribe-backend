FROM php:8.4-cli-alpine

ARG UID=1000
ARG GID=1000

RUN apk add --no-cache \
        supervisor \
        postgresql-dev \
        shadow \
    && docker-php-ext-install -j$(nproc) \
        pdo_pgsql \
        pgsql \
    && rm -rf /var/cache/apk/*

RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data \
    && mkdir -p /var/log/supervisord \
    && chown -R ${UID}:${GID} /var/log/supervisord

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
