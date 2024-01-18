## Use the official PHP image with Apache
#FROM php:8.0-apache
#
## Install system dependencies
#RUN apt-get update && apt-get install -y \
#    git \
#    curl \
#    libpng-dev \
#    libonig-dev \
#    libxml2-dev \
#    zip \
#    unzip
#
## Clear cache
#RUN apt-get clean && rm -rf /var/lib/apt/lists/*
#
## Install PHP extensions
#RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
#
## Get latest Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#
## Set working directory
#WORKDIR /var/www/html
#
## Copy existing application directory contents
#COPY . /var/www/html
#
## Install dependencies
#RUN composer install --no-interaction
#
## Change ownership of our applications
#RUN chown -R www-data:www-data /var/www/html
#
## Copy existing application directory permissions
#COPY --chown=www-data:www-data . /var/www/html
#
## Expose port 80 and 443
#EXPOSE 80 443
#
## Start Apache service
#CMD ["apache2-foreground"]

FROM richarvey/nginx-php-fpm:2.0.4

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG true
ENV LOG_CHANNEL stderr

ENV APP_NAME "Warehouses Manager"


ENV MAIL_MAILER  smtp
ENV MAIL_HOST  smtp.gmail.com
ENV MAIL_PORT  465
ENV MAIL_USERNAME  warehousesmanager0101@gmail.com
ENV MAIL_PASSWORD  "vxpo xvub yhcx njnm"
ENV MAIL_ENCRYPTION ssl
ENV MAIL_FROM_NAME  "Warehouses Manager"

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
