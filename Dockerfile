FROM arm64v8/php:8.0-fpm-alpine3.13
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \ 
  && pecl install xdebug \
  && pecl install mongodb \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS} \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
  && apk add autoconf automake make gcc g++ libtool pkgconfig libmcrypt-dev re2c git zlib-dev xdg-utils libpng-dev freetype-dev libjpeg-turbo-dev openssh-client libxslt-dev ca-certificates gmp-dev \
  && composer require mongodb/mongodb \