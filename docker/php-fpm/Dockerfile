FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    libicu-dev \
    acl \
    sudo \
    gnupg \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

RUN git config --global --add safe.directory /app

RUN docker-php-ext-install \
    pdo \
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

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

RUN usermod -u ${UID} www-data && groupmod -g ${GID} www-data

RUN echo "www-data ALL=(ALL) NOPASSWD: /bin/chown, /bin/chmod, /usr/bin/find" >> /etc/sudoers

RUN mkdir -p /app/storage/logs \
    && mkdir -p /app/storage/framework/cache \
    && mkdir -p /app/storage/framework/sessions \
    && mkdir -p /app/storage/framework/views \
    && mkdir -p /app/bootstrap/cache

RUN chown -R ${UID}:${GID} /app \
    && chmod -R 775 /app \
    && find /app -type d -exec chmod g+s {} \;

RUN sed -i "s/user = www-data/user = www-data/g" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/group = www-data/group = www-data/g" /usr/local/etc/php-fpm.d/www.conf

USER root
COPY --chown=${UID}:${GID} . .
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R ${UID}:${GID} /app \
    && chmod -R 775 /app/storage \
    && chmod -R 775 /app/bootstrap/cache \
    && find /app/storage -name "oauth-*.key" -exec chmod 600 {} \; 2>/dev/null || true \
    && touch /app/storage/logs/laravel.log \
    && chown ${UID}:${GID} /app/storage/logs/laravel.log \
    && chmod 664 /app/storage/logs/laravel.log

USER www-data

RUN echo '#!/bin/bash\nphp artisan "$@"\nsudo chown -R 'www-data':'www-data' /app\n' > /app/artisan-wrapper.sh \
    && chmod +x /app/artisan-wrapper.sh

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
