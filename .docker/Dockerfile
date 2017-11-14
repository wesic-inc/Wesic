FROM php:7.1-apache

MAINTAINER Soufian, Louis, Sylvain, Pierre <saittirite@myges.fr>

RUN apt-get update \
 && docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite

WORKDIR /var/www
