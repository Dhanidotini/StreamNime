# Stage 1: building asset
FROM node:25-alpine AS assets-builder
WORKDIR /app
COPY package.json pnpm-lock.yaml ./
RUN npm install -g pnpm && pnpm install
COPY . .
RUN pnpm run build

# Stage 2: Runtime PHP
FROM dunglas/frankenphp:php8.4-alpine AS runtime
WORKDIR /app

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install system dependencies & PHP Extension
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql redis pcntl bcmath gd zip intl opcache exif

# Copy apllication code
COPY . .
COPY --from=assets-builder /app/public/build ./public/build

# Install composer depedencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permission
RUN chown -R www-data:www-data storage bootstrap/cache

# Caddy / FrankenPHP config
ENV SERVER_NAME=:80
