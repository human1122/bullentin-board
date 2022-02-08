FROM php:7.4-apache

# copy
COPY ./php/php.ini /usr/local/etc/php/

# install
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# change documentroot
COPY ./php/apache/sites-available/000-default.conf /etc/apache2/sites-available/

# update apt package
RUN apt-get update && apt-get -y install \
    git \
    zip \
    unzip \
    vim && docker-php-ext-install pdo_mysql
