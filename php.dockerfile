FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    vim

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY ./andele-backend /var/www

# Install all PHP dependencies
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

# ch owner to www-data 
RUN chown -R www-data:www-data /var/www/

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000

# Copy .env.example to .env if .env does not exist
RUN cp .env.example .env

# Generate application key
RUN php artisan key:generate

# Run migrations
#RUN php artisan migrate --force
