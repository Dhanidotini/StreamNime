# Stage 1: Build frontend assets
FROM node:25-slim AS frontend-builder
ENV PNPM_HOME="/pnpm"
ENV PATH="$PNPM_HOME:$PATH"
RUN npm install --global pnpm

WORKDIR /app
COPY package.json pnpm-lock.yaml ./
RUN pnpm install --frozen-lockfile

COPY . .
RUN pnpm run build

# Stage 2: Final production image
FROM dunglas/frankenphp:1.12.2-php8.4

# Install PHP extensions for Octane
RUN install-php-extensions pcntl pdo_mysql mbstring bcmath gd zip intl opcache exif

WORKDIR /app

# Copy application code and built assets
COPY . .
COPY --from=frontend-builder /app/public/build ./public/build

# Install PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-dev

# Permissions
RUN chown -R www-data:www-data /app \
    && chmod -R 775 storage bootstrap/cache

ENTRYPOINT ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000"]
