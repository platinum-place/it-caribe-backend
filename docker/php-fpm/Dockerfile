FROM bitnami/php-fpm:8.4

ARG UID=1000
ARG GID=1000

USER root

RUN install_packages libpq-dev \
    && echo "extension=pdo_pgsql" > /opt/bitnami/php/etc/conf.d/pdo_pgsql.ini

RUN groupadd -g $GID appgroup

RUN useradd -u $UID -g $GID -m -s /bin/bash laravel

RUN usermod -u $UID -g $GID laravel

RUN mkdir -p /app && chown -R $UID:$GID /app

RUN chown -R $UID:$GID /opt/bitnami/php/logs \
    && chown -R $UID:$GID /opt/bitnami/php/tmp \
    && chown -R $UID:$GID /opt/bitnami/php/var

RUN mkdir -p /app && chown -R $UID:$GID /app

WORKDIR /app

USER $UID
