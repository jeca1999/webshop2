# Use PHP base image with dependencies
FROM php:8.2-cli

# Install system dependencies and upgrade packages for security
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    nodejs npm \
    && apt-get upgrade -y \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www



# Copy composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Now copy the rest of the application
COPY . .

# Show PHP and Composer version, then run Composer with verbose output for debugging
RUN php -v && composer -V && composer install --no-dev --optimize-autoloader --prefer-dist --no-progress -vvv

# Build frontend assets
RUN npm install && npm run build

# Set permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache

# Set Laravel environment to production
ENV APP_ENV=production
ENV APP_DEBUG=false

# Expose Laravel default dev server port
EXPOSE 8000

# Run migrations and then start Laravel development server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
