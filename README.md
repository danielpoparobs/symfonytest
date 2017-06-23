Symfony 3 Docker
========================

A Symfony 3 project utilizing Docker based on PHP-FPM and Nginx.

### Installation

1. Build containers with

```bash
$ docker-compose build
```

2. Prepare Symfony app

```
$ docker-compose run composer install
```

3. Run containers with

```bash
$ docker-compose up -d
```

Now you can access the application in your browser at http://localhost

Enjoy :-)

### Jupyter

```bash
$ docker-compose -f docker-compose.jupyter.yml build
$ docker-compose  -f docker-compose.jupyter.yml up
```
## Useful commands

```bash

$ docker-compose restart

# Composer (e.g. composer update)
$ docker-compose run composer update

# Symfony commands
$ docker-compose exec php bin/console

# PHPUnit
$ docker-compose exec php bin/phpunit 
```