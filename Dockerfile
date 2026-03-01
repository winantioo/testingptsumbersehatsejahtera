FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
