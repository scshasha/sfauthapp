FROM php:7.1-fpm

RUN docker-php-ext-install pdo_mysql

WORKDIR "../../code"

CMD ["php-fpm"]

EXPOSE 9000
