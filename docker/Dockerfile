# =================================================================
# Base stage
# =================================================================
FROM php:8.4-fpm-alpine AS base

# Install helper script docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apk add --no-cache git curl zip unzip fcgi \
    && install-php-extensions pdo_mysql intl zip bcmath gd exif pcntl redis

WORKDIR /var/www


# =================================================================
# Development stage
# =================================================================
FROM base AS development

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apk add --no-cache nodejs npm \
    && npm install -g corepack \
    && corepack enable \
    && corepack prepare pnpm@latest --activate
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]


# =================================================================
# Build assets (Production stage)
# =================================================================
FROM node:22-alpine AS build-assets

WORKDIR /app
RUN corepack enable pnpm && corepack prepare pnpm@latest --activate
COPY package.json pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile
COPY . .
RUN pnpm run build


# =================================================================
# Build vendor (Production stage)
# =================================================================
FROM composer:latest AS build-vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts --ignore-platform-reqs


# =================================================================
# Production stage
# =================================================================
FROM base AS production

COPY --from=build-assets /app/public/build /var/www/public/build
COPY --from=build-vendor /app/vendor /var/www/vendor
COPY . .
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
EXPOSE 9000
CMD ["php-fpm"]