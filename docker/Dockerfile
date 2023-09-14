FROM php:8.1-fpm-alpine

RUN pecl channel-update pecl.php.net

RUN docker-php-ext-install exif \
    && docker-php-ext-enable exif

RUN apk add bash

RUN set -ex && apk --no-cache add libxml2-dev
RUN docker-php-ext-install soap

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
