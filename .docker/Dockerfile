FROM php:7.1-apache

MAINTAINER Soufian, Louis, Sylvain, Pierre <saittirite@myges.fr>

RUN apt-get update \
 && docker-php-ext-install pdo pdo_mysql
# yaml
RUN buildRequirements="libyaml-dev" \
	&& apt-get update && apt-get install -y ${buildRequirements} \
	&& pecl install yaml-2.0.0 \
	&& echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini \
	&& apt-get purge -y ${buildRequirements} \
	&& rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

WORKDIR /var/www
