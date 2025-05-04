# Use PHP 8.2 FPM image
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libssl-dev \
    nginx \
    supervisor \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . /var/www

# Set file permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache


# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy Nginx config file
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy Supervisor config file
COPY docker/supervisord.conf /etc/supervisord.conf

# Expose port
EXPOSE 80

# Start both PHP-FPM and Nginx using Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
