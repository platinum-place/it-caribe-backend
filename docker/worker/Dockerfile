FROM php:8.4-cli

ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y \
    supervisor \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pgsql

RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir -p /var/log/supervisord
RUN chown -R ${UID}:${GID} /var/log/supervisord

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
