FROM bitnami/php-fpm:8.4

ARG UID=1000
ARG GID=1000

USER root

RUN install_packages libpq-dev \
    && echo "extension=pdo_pgsql" > /opt/bitnami/php/etc/conf.d/pdo_pgsql.ini \
    && echo "extension=bcmath" > /opt/bitnami/php/etc/conf.d/bcmath.ini \
    && echo "extension=gd" > /opt/bitnami/php/etc/conf.d/gd.ini \
    && echo "extension=zip" > /opt/bitnami/php/etc/conf.d/zip.ini \
    && echo "extension=exif" > /opt/bitnami/php/etc/conf.d/exif.ini \
    && echo "extension=pcntl" > /opt/bitnami/php/etc/conf.d/pcntl.ini \
    && echo "extension=intl" > /opt/bitnami/php/etc/conf.d/intl.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

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
