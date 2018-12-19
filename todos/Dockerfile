FROM php:7.1-fpm-jessie

RUN apt-get update
RUN apt-get install -y git vim zip unzip cron

RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN apt-get install -y nodejs
RUN apt-get install -y make
RUN apt-get install -y libpng-dev

COPY crontab /etc/cron.d/crontab
RUN crontab /etc/cron.d/crontab

WORKDIR /var/www/todos