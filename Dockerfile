FROM php:8.3-apache

# 1. Install sistem dependensi & Node.js
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    zip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# 2. Konfigurasi dan install ekstensi PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl intl gd

# 3. Aktifkan mod_rewrite
RUN a2enmod rewrite

# 4. Ubah DocumentRoot ke public/ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ✅ TAMBAHAN: AllowOverride agar .htaccess Laravel berfungsi
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# 5. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 6. Set direktori kerja dan copy project
WORKDIR /var/www/html
COPY . .

# 7. Install dependencies & build
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# 8. Permission storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ✅ TAMBAHAN: Cache Laravel saat build
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# 9. CMD: migrate + storage:link + jalankan Apache
CMD ["sh", "-c", "php artisan migrate --force && php artisan storage:link --force && apache2-foreground"]
