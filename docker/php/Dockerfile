FROM php:7.3-fpm
COPY ./docker/php/php.ini /usr/local/etc/php/
COPY ./server /work

RUN apt-get update && apt-get -y upgrade

RUN apt-get install -y zlib1g-dev \ 
    libzip-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick
RUN docker-php-ext-configure \
    gd --with-freetype-dir=/usr/include --with-png-dir=/usr/include --with-jpeg-dir=/usr/include
RUN docker-php-ext-install pdo_mysql zip gd \
    && docker-php-ext-enable imagick
#by using npm install
RUN curl -SL https://deb.nodesource.com/setup_15.x | bash   
RUN apt-get install -y nodejs

#imagemagick
# RUN apt-get update && apt-get install -y \
#     libmagickwand-dev --no-install-recommends \
#     && pecl install imagick \
# 	&& docker-php-ext-enable imagick

#Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

WORKDIR /work

RUN composer global require "laravel/installer"

