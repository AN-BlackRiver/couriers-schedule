FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    postgresql-dev \
    && docker-php-ext-install pdo_pgsql pgsql

WORKDIR /var/www/html