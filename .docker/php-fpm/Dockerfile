FROM php:7.3-fpm-alpine

RUN docker-php-ext-install pdo_mysql

WORKDIR "../../code"

CMD ["php-fpm"]

EXPOSE 9000
