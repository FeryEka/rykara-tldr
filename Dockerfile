# 1. Base Image: PHP 8.4
FROM php:8.4-cli

# 2. Install Library OS Wajib
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# 3. Install Extension PHP Wajib (Termasuk MySQL & Gambar)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Ambil Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Setup Folder Kerja
WORKDIR /app

# 6. Copy File Project (Semua, bukan cuma Models)
COPY . .

# 7. Install Dependency Laravel
RUN composer install --optimize-autoloader --no-interaction --no-progress --ignore-platform-reqs

# 8. Setup Permission Storage (Biar gak error Permission Denied)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# 9. Expose Port
EXPOSE 8080

# 10. Perintah Start (Migrate + Link + Serve)
CMD php artisan migrate --force && \
    php artisan storage:link && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8080}