FROM php:7.4-apache

RUN apt-get update
RUN apt-get install -y libfreetype6-dev libjpeg-dev libgd-dev libpng-dev vim wget zlib1g-dev zip
RUN docker-php-ext-configure gd --with-jpeg --enable-gd
RUN docker-php-ext-install -j$(nproc) bcmath gd mbstring
RUN php -m
RUN php -r "var_dump(gd_info());" | grep JPEG -A1

# html2pdf
RUN wget https://github.com/spipu/html2pdf/archive/refs/heads/master.zip
RUN unzip master.zip -d ../vendor
RUN rm master.zip