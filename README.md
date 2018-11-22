# PHP laravel docker development starter

## Docker container for development

- Nginx (front server)
- App (php-fpm laravel server)
- Mysql (db)
- Redis
- OpenAPI (swagger-ui)

## Requires

- docker, docker-compose https://docs.docker.com/compose/install/#install-compose
- php, composer (using swagger-php's local yml building)

## Installing

```sh
# clone and new repositry
$ git clone [this repo] ./project-name
$ cd ./project-name
$ rm -rf ./.git
$ git init

# create laravel project
$ composer create-project laravel/laravel laravel --prefer-dist
$ chmod -R 777 laravel/storage
$ cd laravel
$ composer require zircote/swagger-php
# optional
$ composer require barryvdh/laravel-cors
```

## Getting started

1. Edit `/docker_local/.env`
1. Run

```sh
$ cd /path/to/this/repo
$ cd docker_local
$ docker-compose up
```

1. Browser access

- `http://localhost` ... nginx (php-fpm)
- `http://localhost:8080` ... swagger-ui

## Staging, Production building

1. Edit `/docker/*` settings.
2. `$ docker-compose build`

### Tips

- `docker-compose exec app sh` shell login `app` container.
- swagger-php
  - annotations http://zircote.com/swagger-php/Getting-started.html
  - Update yaml file `$ php openapi.php`
