FROM php:5.6-apache

MAINTAINER Soufian, Louis, Sylvain, Pierre <saittirite@myges.fr>

RUN apt-get update \
 && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
