FROM php:7-fpm-alpine
# https://github.com/docker-library/php/blob/f363b9f8a0e23e79faaa624ff5bf160b9dec18f4/7.2/alpine3.8/fpm/Dockerfile

ENV COMPOSER_ALLOW_SUPERUSER 1
# ENV PHP_EXTRA_CONFIGURE_ARGS --with-apxs2

# $PHPIZE_DEPSはdocker-php-ext-*実行後に自動で削除される
RUN apk add zlib-dev libmemcached-dev
RUN apk add --no-cache $PHPIZE_DEPS \
  && pecl install memcached-3.0.4 \
  && docker-php-ext-enable memcached
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  && php composer-setup.php \
  && php -r "unlink('composer-setup.php');" \
  && mv composer.phar /usr/local/bin/composer

RUN mkdir -p /app
ADD ./laravel/ /app/laravel/

WORKDIR /app/laravel

RUN composer install
RUN cp .env.example .env
# TODO .envファイルをs3から取ってくる
RUN php artisan key:generate
RUN chmod -R a+w storage/ bootstrap/cache
