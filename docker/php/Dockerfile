FROM php:7.1-fpm

RUN usermod -u 1000 www-data

ADD start.sh /start.sh
RUN chmod -v +x /start.sh

CMD ["/start.sh"]