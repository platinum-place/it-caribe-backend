FROM php:8.4-cli

ARG UID=1000
ARG GID=1000

# Instala dependencias del sistema, incluyendo libicu-dev
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    gosu \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instala extensiones de PHP, incluyendo intl
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# First, remove the existing www-data user if it exists
RUN if id "www-data" >/dev/null 2>&1; then userdel www-data; fi
RUN if getent group www-data >/dev/null 2>&1; then groupdel www-data; fi

# Create new group and user with specified UID/GID
RUN groupadd --force -g $GID www-data
RUN useradd -ms /bin/bash --no-user-group -g www-data -u $UID www-data

WORKDIR /var/www/html

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php", "-a"]
