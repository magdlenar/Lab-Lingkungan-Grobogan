FROM php:8.2-cli

# System deps
RUN apt-get update && apt-get install -y \
    git unzip curl nodejs npm libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Install & build frontend (Vite)
RUN npm install && npm run build

EXPOSE 8080

CMD php -S 0.0.0.0:$PORT -t public server.php
