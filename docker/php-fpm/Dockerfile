FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

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

RUN groupadd -g ${GID} appgroup && \
    useradd -u ${UID} -g appgroup -m -s /bin/bash appuser

RUN sed -i 's/^user = www-data$/user = appuser/' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's/^group = www-data$/group = appgroup/' /usr/local/etc/php-fpm.d/www.conf

RUN mkdir -p /var/log/php-fpm && \
    chown -R appuser:appgroup /var/log/php-fpm

WORKDIR /var/www/html

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

EXPOSE 9000

CMD ["php-fpm"]
