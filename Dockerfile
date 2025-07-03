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

# Copy composer files first (for Docker cache)
COPY composer.json composer.lock ./

# Copy the full app
COPY . .

# Show PHP & Composer versions and install Laravel dependencies
RUN php -v && composer -V \
    && composer install --no-dev --optimize-autoloader --prefer-dist --no-progress -vvv

# Build frontend assets
RUN npm install && npm run build

# Set Laravel folder permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear cache to prevent stale config
RUN php artisan config:clear && php artisan cache:clear

# Set Laravel environment
ENV APP_ENV=production
ENV APP_DEBUG=false

# Expose Laravel port
EXPOSE 8000

# Migrate and seed seller, then serve the app
CMD php artisan migrate --force \
    && php artisan db:seed --class=SellerSeeder --force \
    && php artisan serve --host=0.0.0.0 --port=8000
