# Use PHP base image with dependencies
FROM php:8.2-cli

# Install system dependencies and upgrade packages
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    nodejs npm \
    && apt-get upgrade -y \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy environment file
COPY .env .env

# Copy composer files first (better Docker cache usage)
COPY composer.json composer.lock ./

# Copy application files
COPY . .

# Show versions and install PHP dependencies
RUN php -v && composer -V \
    && composer install --no-dev --optimize-autoloader --prefer-dist --no-progress -vvv

# Build frontend assets
RUN npm install && npm run build

# Set Laravel folder permissions
RUN chmod -R 775 storage bootstrap/cache

# Set Laravel environment
ENV APP_ENV=production
ENV APP_DEBUG=false

# Expose Laravel port
EXPOSE 8000

# Safe: Run migrations and seed only SellerSeeder, then start app
CMD php artisan migrate --force \
    && php artisan db:seed --class=SellerSeeder --force \
    && php artisan serve --host=0.0.0.0 --port=8000
