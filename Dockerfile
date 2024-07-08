FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql

COPY ./php.ini /usr/local/etc/php/php.ini