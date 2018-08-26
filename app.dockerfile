FROM php:7.2-apache

# copy the config file to the correct location
RUN a2enmod rewrite
COPY ./httpd.conf /etc/apache2/sites-enabled/cah.conf

# install php-mysql extension
RUN apt-get update \
	&& apt-get install -y mysql-client --no-install-recommends \
	&& docker-php-ext-install pdo_mysql

# install node js and npm
RUN apt-get install -y gnupg \
	&& curl -sL https://deb.nodesource.com/setup_8.x | bash -  \
	&& apt-get install -y nodejs