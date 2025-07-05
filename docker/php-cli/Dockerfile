FROM php:8.4-cli-alpine

RUN apk add --no-cache \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    postgresql-dev \
    shadow \
    git \
    unzip \
    curl \
    nodejs \
    npm \
    bash \
    su-exec

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

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG UID=1000
ARG GID=1000
RUN groupmod -g $GID www-data && \
    usermod -u $UID -g $GID www-data

RUN mkdir -p /var/www/html \
    && chown -R www-data:www-data /var/www/html

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

ENTRYPOINT ["/entrypoint.sh"]
