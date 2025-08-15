FROM bitnami/php-fpm:8.4

USER root

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && install_packages nodejs

ARG WWWUSER
ARG WWWGROUP

RUN groupadd -g ${WWWGROUP} laravel || groupmod -g ${WWWGROUP} laravel || true \
    && useradd -u ${WWWUSER} -g laravel -m laravel || usermod -u ${WWWUSER} laravel || true

RUN mkdir -p /app/storage /app/bootstrap/cache /opt/bitnami/php/logs \
    && chown -R laravel:laravel /app /opt/bitnami/php/logs \
    && chmod -R 775 /app/storage /app/bootstrap/cache /opt/bitnami/php/logs

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

USER laravel
WORKDIR /app

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["/opt/bitnami/php/sbin/php-fpm", "--nodaemonize"]
