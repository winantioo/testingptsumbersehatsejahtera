FROM php:8.3-apache

# 1. Install sistem dependensi & Node.js (Diperbarui)
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

# 3. Aktifkan modul rewrite Apache
RUN a2enmod rewrite

# 4. Ubah DocumentRoot Apache ke folder public/ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 6. Set direktori kerja dan copy project
WORKDIR /var/www/html
COPY . .

# 7. Install dependensi PHP, Node.js, dan Build Vite (Diperbarui)
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Perintah Runtime: Set Port Dinamis Railway & Matikan modul MPM yang bentrok
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT:-8080}/g\" /etc/apache2/ports.conf && sed -i \"s/:80/:${PORT:-8080}/g\" /etc/apache2/sites-available/000-default.conf && a2dismod mpm_event mpm_worker 2>/dev/null || true && a2enmod mpm_prefork && apache2-foreground"]
