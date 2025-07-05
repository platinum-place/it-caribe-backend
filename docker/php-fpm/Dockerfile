FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    postgresql-dev \
    shadow

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        pdo_pgsql \
        zip \
        gd \
        mbstring \
        intl \
        bcmath \
        exif \
        pcntl

ARG UID=1000
ARG GID=1000
RUN groupmod -g $GID www-data && \
    usermod -u $UID -g $GID www-data

RUN mkdir -p /var/www/html \
    && chown -R www-data:www-data /var/www/html

RUN echo "user = www-data" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "group = www-data" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "listen.owner = www-data" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "listen.group = www-data" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "listen.mode = 0666" >> /usr/local/etc/php-fpm.d/www.conf

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

USER www-data

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
