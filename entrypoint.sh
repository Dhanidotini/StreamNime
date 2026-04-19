#!/bin/sh
set -e

echo "Running file entrypoint..."

sleep 2

echo "Reoptimize..."
php artisan optimize:clear
php artisan optimize

echo "Migrating database..."
php artisan migrate --force

echo "Refresh filament..."
php artisan filament:upgrade

echo "Make storage link"
php artisan storage:link

echo "Start FrankenPHP..."
exec frankenphp run --config /etc/caddy/Caddyfile
