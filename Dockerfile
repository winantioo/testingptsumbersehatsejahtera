FROM php:8.3-apache

# 1. Perbaiki Error MPM (Mencegah lebih dari 1 modul berjalan bersamaan)
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# 2. Install sistem dependensi
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
    && rm -rf /var/lib/apt/lists/* # 3. Konfigurasi dan install ekstensi PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    intl \
    gd

# 4. Aktifkan modul rewrite Apache (Wajib untuk URL Laravel)
RUN a2enmod rewrite

# 5. Ubah DocumentRoot Apache agar mengarah ke folder public/ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Agar Apache membaca Port dinamis dari Railway (Railway menggunakan variabel $PORT)
RUN sed -i 's/Listen 80/Listen ${PORT:-80}/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:${PORT:-80}/g' /etc/apache2/sites-available/000-default.conf

# 7. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 8. Set direktori kerja
WORKDIR /var/www/html

# 9. Copy semua file project ke dalam container
COPY . .

# 10. Install dependensi Laravel (tanpa package dev)
RUN composer install --no-dev --optimize-autoloader

# 11. Berikan hak akses (Permission) pada folder storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 12. Buka port standar (sebagai fallback)
EXPOSE 80

CMD ["bash", "-c", "a2dismod mpm_event mpm_worker 2>/dev/null || true; rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.* 2>/dev/null || true; a2enmod mpm_prefork; exec apache2-foreground"]
