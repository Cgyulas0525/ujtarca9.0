#!/bin/sh
set -e

# ha nincs vendor, telepít composer
if [ ! -d "vendor" ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# storage és bootstrap/cache jogosultságok
chmod -R 775 storage bootstrap/cache || true

exec "$@"
