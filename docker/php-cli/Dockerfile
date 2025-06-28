FROM php:8.4-cli

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libxml2-dev \
    libicu-dev \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    nodejs \
    npm \
    gosu \
 && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-configure intl \
 && docker-php-ext-install \
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

# Instalar Xdebug
RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

# Copiar y ejecutar script de entrada
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["bash"]
