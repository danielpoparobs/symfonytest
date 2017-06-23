#!/bin/bash

chown www-data:www-data -R /var/www/application/var/cache
chown www-data:www-data -R /var/www/application/var/sessions
chown www-data:www-data -R /var/www/application/var/logs

php-fpm