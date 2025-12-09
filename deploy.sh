#!/bin/bash
set -e

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Discard local changes
git reset --hard HEAD
git clean -fd

# Pull the latest version of the app
git pull origin main

# Install composer dependencies
# check if the environment is local or staging vs production
if [ "$APP_ENV" = "local" || "$APP_ENV" = "staging" ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
else
    composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
fi

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize

# Compile npm assets
# npm run prod

# Run database migrations
# check if the environment is local or staging vs production
if [ "$APP_ENV" = "local" || "$APP_ENV" = "staging" ]; then
    php artisan migrate:fresh --seed --force
else
    php artisan migrate:fresh --force
fi

# Exit maintenance mode
php artisan up

echo "Deployment finished!"