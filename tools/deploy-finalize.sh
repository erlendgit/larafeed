#!/usr/bin/env bash
set -eo pipefail

npm install > /dev/null
npm run prod --quiet

echo "Migrate..."
php artisan migrate

echo "Create config cache..."
php artisan config:clear
php artisan config:cache

echo "Create route cache..."
php artisan route:clear
php artisan route:cache

echo "Create view cache..."
php artisan view:clear
php artisan view:cache

echo "Update folder permissions"
chmod a+w -Rf storage/
