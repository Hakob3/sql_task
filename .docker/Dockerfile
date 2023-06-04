FROM php:8.1.13-fpm

RUN apt update
RUN apt install -y git

# Установка необходимых расширений PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка библиотеки PhpSpreadsheet
RUN composer require phpoffice/phpspreadsheet:^1.18

WORKDIR /var/www