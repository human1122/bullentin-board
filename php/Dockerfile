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
    nodejs \
    npm \
    vim

# php library install
RUN docker-php-ext-install pdo_mysql

# npm
RUN update-alternatives --install /usr/bin/node node /usr/bin/nodejs 10
RUN npm install
RUN npm i -- save-dev laravel-mix@latest
# localで実行しないと意味なかった
# RUN npm install axios

# activation
RUN cd /etc/apache2/mods-enabled \
    && ln -s ../mods-available/rewrite.load
