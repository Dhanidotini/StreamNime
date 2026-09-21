#!/bin/sh

set -e

umask 002

if [ ! -d "vendor" ]; then
    echo "====> Installing Composer dependencies..."
    composer install --no-interaction
fi

if [ ! -d "node_modules" ]; then
    echo "====> Installing PNPM packages..."
    pnpm install
fi

if [ ! -d "public/build" ]; then
    echo "====> Building assets with Vite & PNPM..."
    pnpm run build
fi

echo "====> Setting storage permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "====> Running database migrations and seeding..."
php artisan migrate --force --no-interaction
php artisan db:seed --class=UserSeeder

echo "====> Generating Shield resources..."
php artisan shield:generate -n --panel=dashboard --all

echo "====> Assign Super-Admin to User"
php artisan shield:super-admin -n --panel=dashboard --user=1

echo "====> Starting Application..."
exec "$@"