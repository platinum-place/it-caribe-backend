FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libicu-dev \
    zip \
    unzip \
    curl

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd xml zip intl

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Configure OPcache for performance
RUN docker-php-ext-install opcache

# Copy PHP configuration
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Create system user
RUN groupadd -g $GID laravel && \
    useradd -u $UID -g laravel -m -s /bin/bash laravel

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Switch to non-root user
USER laravel

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
