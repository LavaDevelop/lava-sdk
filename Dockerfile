FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        nano

COPY --from=composer:2.0.7 /usr/bin/composer /usr/bin/composer
COPY . /var/www

RUN composer install -d /var/www

WORKDIR /var/www
