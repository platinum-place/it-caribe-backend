FROM php:8.4-fpm-alpine

ARG UID=1000
ARG GID=1000

RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    icu-dev \
    acl \
    sudo \
    nodejs \
    npm \
    shadow \
    freetype-dev \
    libjpeg-turbo-dev \
    && rm -rf /var/cache/apk/*

RUN git config --global --add safe.directory /app

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache \
        intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data \
    && echo "www-data ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/find" >> /etc/sudoers

USER root
COPY --chown=${UID}:${GID} . .
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN mkdir -p \
        storage/logs \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        bootstrap/cache \
    && chown -R ${UID}:${GID} /app \
    && chmod -R 775 storage bootstrap/cache \
    && touch storage/logs/laravel.log \
    && chmod 664 storage/logs/laravel.log

RUN sed -i 's/user = www-data/user = www-data/g' /usr/local/etc/php-fpm.d/www.conf \
    && sed -i 's/group = www-data/group = www-data/g' /usr/local/etc/php-fpm.d/www.conf \
    && find storage -name "oauth-*.key" -exec chmod 600 {} \; 2>/dev/null || true

USER www-data

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
