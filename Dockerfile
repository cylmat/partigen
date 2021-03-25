FROM php:7.4-apache

RUN apt-get update
RUN apt-get install -y libfreetype6-dev libjpeg-dev libgd-dev libonig-dev libpng-dev zlib1g-dev git vim wget zip
RUN docker-php-ext-configure gd --with-jpeg --enable-gd
RUN docker-php-ext-install -j$(nproc) bcmath gd mbstring

# imagick
RUN apt-get install -y libmagickwand-dev
RUN echo '' | pecl install imagick
RUN echo "extension=imagick.so" > /usr/local/etc/php/conf.d/imagick.ini
RUN sed -ie 's#<policy domain="coder" rights="none" pattern="PDF" />##' $(find /etc/Image* -name policy.xml)

# composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer && chmod a+x /usr/local/bin/composer

WORKDIR /var/www