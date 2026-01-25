FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev libicu-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql pgsql intl opcache zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# buat folder yang diperlukan sebelum composer install
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear


CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
