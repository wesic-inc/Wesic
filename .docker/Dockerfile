FROM php:7.1-apache

MAINTAINER Soufian, Louis, Sylvain, Pierre <saittirite@myges.fr>

RUN apt-get update && apt-get install -q -y ssmtp mailutils

# set up sendmail config, see http://linux.die.net/man/5/ssmtp.conf for options

RUN echo "root:wesic.corporate@gmail.com:smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf

RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf

RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf

RUN echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf

RUN echo "AuthUser=wesic.corporate@gmail.com" >> /etc/ssmtp/ssmtp.conf

RUN echo "AuthPass=wesic2018" >> /etc/ssmtp/ssmtp.conf

# Set up php sendmail config

RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini



# Fully qualified domain name configuration for sendmail on localhost.

# Without this sendmail will not work.

# This must match the value for 'hostname' field that you set in ssmtp.conf.

# RUN echo "localhost localhost.localdomain" >> /etc/hosts


RUN docker-php-ext-install pdo pdo_mysql
# yaml
RUN buildRequirements="libyaml-dev" \
	&& apt-get install -y ${buildRequirements} \
	&& pecl install yaml-2.0.0 \
	&& echo "extension=yaml.so" > /usr/local/etc/php/conf.d/ext-yaml.ini \
	&& apt-get purge -y ${buildRequirements} \
	&& rm -rf /var/lib/apt/lists/*



RUN a2enmod rewrite

WORKDIR /var/www
