FROM php:8.1-fpm

RUN \
   apt update \
    && apt install -y \
    git \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-install mysqli

RUN pecl install xdebug && docker-php-ext-enable xdebug

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
