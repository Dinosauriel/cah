FROM php:7.2-apache

COPY . /var/www/html/
COPY ./httpd.conf /usr/local/apache2/conf/httpd.conf