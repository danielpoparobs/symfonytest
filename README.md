Symfony 3 Docker
========================

A Symfony 3 project utilizing Docker based on PHP-FPM and Nginx.

### Installation

1. Build/run containers with

```bash
$ docker-compose build
$ docker-compose up -d
```

2. Prepare Symfony app

```
$ docker-compose run composer install
```

*

Now you can access the application in your browser at http://localhost

Enjoy :-)

## Useful commands

```bash
# Composer (e.g. composer update)
$ docker-compose run composer update

# Symfony commands
$ docker-compose exec php php bin/console

# PHPUnit
$ docker-compose exec php bin/phpunit 
```