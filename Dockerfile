FROM bitnami/php-fpm:8.4

ARG UID=1000
ARG GID=1000

USER root

RUN install_packages  \
    libpq-dev  \
    supervisor \
    && echo "extension=pdo_pgsql" > /opt/bitnami/php/etc/conf.d/pdo_pgsql.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && install_packages nodejs

RUN groupadd -g $GID appgroup \
    && useradd -u $UID -g $GID -m -s /bin/bash laravel \
    && usermod -u $UID -g $GID laravel \
    && mkdir -p /app \
    && mkdir -p /var/log/supervisord \
    && chown -R $UID:$GID /app \
    && chown -R $UID:$GID /opt/bitnami/php/logs \
    && chown -R $UID:$GID /opt/bitnami/php/tmp \
    && chown -R $UID:$GID /opt/bitnami/php/var \
    && chown -R $UID:$GID /var/log/supervisord

WORKDIR /app

USER $UID
