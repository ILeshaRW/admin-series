FROM php:8.2-fpm as base

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_pgsql pgsql intl

# Install Redis
RUN pecl install -o -f redis
RUN docker-php-ext-enable redis

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy php.ini
COPY php.ini /usr/local/etc/php/php.ini

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/html

USER $user

# Цель для локально разработки с установкой xdebug
FROM base AS xdebug
USER root

ARG user
ARG uid

# Install xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

USER $user
