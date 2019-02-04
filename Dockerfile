#-----------------------------------------------------------------------
# To create the docker image :
# cd <this file directory>
# docker build -t battleshipgame .
#
# Start image :
#docker-compose up

#after
#docker-compose exec php battleshipgame ./init.bash

#or execute
#docker-compose exec battleshipgame composer install
#docker-compose exec battleshipgame php artisan key:generate
#docker-compose exec battleshipgame php artisan migrate:fresh
#chmod -R 775 storage

#
# Open browser :
# http://localhost:8081
# or (configure local files add battleship-game.local to /etc/hosts)
# http://battleship-game.local:8081
#-----------------------------------------------------------------------

FROM php:7.2-apache

RUN apt-get -qq update \
 && apt-get -qq -y install libmcrypt-dev git vim nano zip unzip mysql-client bzip2 zlib1g-dev libmemcached-dev \
 && pecl install mcrypt-1.0.1 \
 && docker-php-ext-enable mcrypt \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-install mysqli

RUN echo 'alias ll="ls -la"' >> ~/.bashrc

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN a2enmod rewrite
RUN service apache2 restart
