FROM php:8.2-cli

# Install system dependencies (with libpq-dev and build tools)
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libonig-dev libxml2-dev libpng-dev \
    libbrotli-dev pkg-config libpq-dev gcc make autoconf libc-dev pkg-config \
    && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql mbstring pcntl

# Install swoole
RUN pecl install swoole && docker-php-ext-enable swoole

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN php artisan octane:install --server=swoole

EXPOSE 8000

CMD ["php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0", "--port=8000"]
