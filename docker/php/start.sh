#!/bin/sh

cd /var/www/app

composer install --no-interaction --prefer-dist

php artisan key:generate --force --no-interaction

mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

chmod -R 775 storage bootstrap/cache

php artisan config:clear
php artisan migrate --seed --force --no-interaction

php-fpm