# Stage 1: building asset
FROM node:25-alpine AS assets-builder
WORKDIR /app
COPY package.json pnpm-lock.yaml ./
RUN nom install -g pnpm && pnpm install
COPY . .
RUN pnpm run build

# Stage 2: Runtime PHP
FROM dunglas/frankenphp:php8.4-alpine AS runtime
WORKDIR /app

# Install system dependencies & PHP Extension
RUN install-php-extension \
    ctype \
    curl \
    dom \
    fileinfo \
    filter \
    hash \
    mbstring \
    openssl \
    pcre \
    pro_mysql \
    pdo_sqlite \
    session \
    tokenizer \
    xml \
    redis \
    pcntl \
    bcmath \
    gd \
    zip \
    opcache \
    intl

# Copy apllication code
COPY . .
COPY --from=assets-builder /app/public/build ./public/build

# Install composer depedencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permission
RUN chown -R www-data:www-data storage bootstrap/cache

# Optimize laravel
RUN php artisan optimize

# Caddy / FrankenPHP config
ENV SERVER_NAME=:80
