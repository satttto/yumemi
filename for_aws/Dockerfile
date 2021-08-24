FROM php:8.0-apache

RUN apt-get update && apt-get upgrade -y
RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev libjpeg-dev 

RUN docker-php-ext-install bcmath pdo_mysql gd zip sockets
RUN pecl install igbinary-3.1.6 redis-5.3.2 && docker-php-ext-enable redis

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Apache Configuration
RUN sed -i -e 's#/var/www/html#/var/www/html/public#' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

COPY . /var/www/html

RUN chmod -R 0777 /var/www/html/storage/ /var/www/html/bootstrap/cache /var/www/html/resources/
RUN composer install --optimize-autoloader --no-progress --no-suggest --no-dev

RUN php -r "file_exists('.env') || copy('.env.example', '.env');"
RUN php artisan route:list

EXPOSE 80

