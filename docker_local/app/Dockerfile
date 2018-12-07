FROM php:7-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1
# ENV PHP_EXTRA_CONFIGURE_ARGS --with-apxs2

# phpize
RUN apk add --no-cache --virtual .additional-deps $PHPIZE_DEPS \
  # memcached
  && apk add zlib-dev libmemcached-dev && pecl install memcached-3.0.4 && docker-php-ext-enable memcached \
  # additonal ext
  && docker-php-ext-install zip pdo pdo_mysql bcmath \
  # geoip
  && wget http://geolite.maxmind.com/download/geoip/database/GeoLiteCountry/GeoIP.dat.gz \
  && gunzip GeoIP.dat.gz \
  && mkdir -p /usr/share/GeoIP \
  && mv GeoIP.dat /usr/share/GeoIP/ \
  && rm -rf ./GeoIP.dat.gz \
  && apk add geoip-dev && pecl install geoip-1.1.1 && docker-php-ext-enable geoip \
  # redis
  && pecl install redis-4.2.0 && docker-php-ext-enable redis \
  # last
  && docker-php-source delete \
  && apk del .additional-deps

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  && php composer-setup.php \
  && php -r "unlink('composer-setup.php');" \
  && mv composer.phar /usr/local/bin/composer

RUN composer --version
