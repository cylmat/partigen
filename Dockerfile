FROM php:7.4-apache

RUN apt-get update
RUN apt-get install -y libfreetype6-dev libjpeg-dev libgd-dev libpng-dev zlib1g-dev git vim wget zip
RUN docker-php-ext-configure gd --with-jpeg --enable-gd
RUN docker-php-ext-install -j$(nproc) bcmath gd mbstring
RUN php -m
RUN php -r "var_dump(gd_info());" | grep JPEG -A1

WORKDIR /var/www
RUN mkdir vendor

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer && chmod a+x /usr/local/bin/composer

# html2pdf
RUN wget https://github.com/spipu/html2pdf/archive/refs/heads/master.zip
RUN unzip master.zip -d vendor
RUN mkdir vendor/spipu && mv vendor/html2pdf-master vendor/spipu/html2pdf
RUN rm master.zip