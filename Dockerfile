FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl nodejs npm default-mysql-client libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 🔽 IMPORT DATABASE (SEKALI SAJA)
RUN mysql \
  -h "$MYSQLHOST" \
  -P "$MYSQLPORT" \
  -u "$MYSQLUSER" \
  -p"$MYSQLPASSWORD" \
  "$MYSQLDATABASE" < aplikasi_lab.sql

EXPOSE 8080
CMD php -S 0.0.0.0:$PORT -t public server.php
