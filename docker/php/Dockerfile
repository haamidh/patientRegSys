FROM php:8.2-fpm

# system deps
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# php extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip gd

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# workdir
WORKDIR /var/www/html

# ensure www-data owns folders (adjust later if needed)
RUN usermod -u 1000 www-data || true