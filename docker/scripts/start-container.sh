#!/bin/sh
set -eu

cd /var/www/html

if [ ! -f .env ] && [ -f .env.docker.example ]; then
    cp .env.docker.example .env
fi

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

if grep -Eq '^APP_KEY=$' .env 2>/dev/null; then
    php artisan key:generate --force
fi

chown -R www-data:www-data storage bootstrap/cache vendor

exec apache2-foreground
