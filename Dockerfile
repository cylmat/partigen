FROM php:7.4-apache

RUN apt-get update
RUN apt-get install -y libfreetype6-dev libjpeg-dev libgd-dev libpng-dev zlib1g-dev
RUN docker-php-ext-configure gd --with-jpeg --enable-gd
RUN docker-php-ext-install -j$(nproc) bcmath gd
RUN php -m
RUN php -r "var_dump(gd_info());" | grep JPEG -A1