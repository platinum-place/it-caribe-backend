FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    gosu \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl

RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    zip \
    xml \
    curl

EXPOSE 9000

CMD ["php-fpm"]
