FROM php:8.4-fpm

# Install system dependencies + PHP extensions
RUN apt-get update \
    && apt-get install -y git unzip curl nodejs npm \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copy only composer files first for caching
COPY composer.json composer.lock ./
RUN composer install --no-interaction --optimize-autoloader

COPY . .

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
