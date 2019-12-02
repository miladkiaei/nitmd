FROM php:7.3.10-fpm-alpine3.9

RUN apk add -U tzdata shadow procps autoconf libzip-dev
RUN docker-php-ext-install bcmath pdo_mysql pcntl

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
USER www-data