FROM php:7.4.10-apache

COPY /src /var/www/html

RUN a2enmod rewrite && \
    service apache2 restart && \
    apt-get update -y && \
    apt-get install git zip -y && \
    docker-php-ext-install pdo_mysql && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    composer install

EXPOSE 80
