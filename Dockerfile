FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www

# Copy source code
COPY . .

# Point Apache to Laravel's public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/public|' /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Optionally run Laravel commands (ensure no route name duplicates)
RUN php artisan config:cache && \
    php artisan view:cache && \
    php artisan storage:link

EXPOSE 80
