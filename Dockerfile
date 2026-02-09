# =========================
# STAGE 1 — FRONTEND (VITE)
# =========================
FROM node:18-alpine AS frontend

WORKDIR /app

COPY . .

RUN npm install
RUN npm run build


# =========================
# STAGE 2 — BACKEND (PHP)
# =========================
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# 👉 copiar SOMENTE o build gerado pelo Vite
COPY --from=frontend /app/public/build public/build

RUN composer install --no-dev --optimize-autoloader

RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080
