FROM php:7.2-apache
RUN apt-get update && apt-get install -y wget git unzip
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable xdebug
RUN a2enmod rewrite

RUN echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini