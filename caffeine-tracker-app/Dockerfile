FROM php:7.4-fpm-alpine
RUN apk update
RUN apk add oniguruma-dev

WORKDIR /var/www/public

RUN docker-php-ext-install mbstring tokenizer mysqli pdo_mysql