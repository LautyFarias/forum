FROM php:7.4.10-apache
RUN a2enmod rewrite && \
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
php -r "unlink('composer-setup.php');" && \
apt-get update -y && \
apt-get install git -y &&\
apt-get install zip -y
RUN composer install
COPY /src /var/www/html
EXPOSE 80