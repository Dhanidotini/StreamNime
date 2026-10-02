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

RUN apk add --no-cache nginx

RUN rm -rf /etc/nginx/http.d/default.conf

RUN echo 'server { \
    listen 80; \
    root /var/www/public; \
    index index.php; \
    charset utf-8; \
    location / { \
        try_files $uri $uri/ /index.php?$query_string; \
    } \
    location ~ \.php$ { \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name; \
        include fastcgi_params; \
        fastcgi_hide_header X-Powered-By; \
    } \
    location ~ /\.(?!well-known).* { \
        deny all; \
    } \
}' > /etc/nginx/http.d/laravel.conf

COPY --from=build-assets /app/public/build /var/www/public/build
COPY --from=build-vendor /app/vendor /var/www/vendor
COPY . .
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN echo '#!/bin/sh' > /start.sh \
    && echo 'php-fpm -D' >> /start.sh \
    && echo 'nginx -g "daemon off;"' >> /start.sh \
    && chmod +x /start.sh
EXPOSE 80
CMD ["./start.sh"]
