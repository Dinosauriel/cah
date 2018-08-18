FROM php:7.2-apache

#copy the config file to the correct location
COPY ./httpd.conf /var/www/html/.htaccess
#install php-mysql extension
RUN apt-get update && apt-get install -y mysql-client --no-install-recommends\
    && docker-php-ext-install pdo_mysql