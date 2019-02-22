FROM php:7.2-apache
RUN apt-get update; \
    apt-get install -y git zip unzip
RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite