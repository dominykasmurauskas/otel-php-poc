FROM php:8.0.8-cli-alpine

ENV DOCUMENT_ROOT /var/www/
WORKDIR ${DOCUMENT_ROOT}
RUN rm -rf "${DOCUMENT_ROOT}/html"

RUN apk add --no-cache pcre-dev icu-dev git
RUN apk add --no-cache libzip-dev curl-dev
RUN apk add --no-cache alpine-sdk openssl-dev php8-dev php8-pear
RUN apk add --no-cache linux-headers
RUN rm -rf /var/cache/apk/*

RUN docker-php-ext-install curl bcmath

RUN pecl install grpc-1.42.0
RUN pecl install protobuf-3.21.1
RUN docker-php-ext-enable grpc protobuf

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
