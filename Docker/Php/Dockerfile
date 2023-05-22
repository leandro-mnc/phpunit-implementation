FROM php:8.2-apache

WORKDIR /var/www/html/

RUN pecl install xdebug \
    && apt update \
    && apt install libzip-dev -y \
    && docker-php-ext-enable xdebug \
    && a2enmod rewrite \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.json .

RUN groupadd -r user && useradd -r -g user user
USER user
RUN composer install --no-dev

COPY . .

USER root

EXPOSE 80