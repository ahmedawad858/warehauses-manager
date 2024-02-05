#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

#echo "installing migrations..."
#php artisan migrate:install

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache



echo "Running migrations..."
php artisan migrate --force


echo "Running Seeder..."
php artisan db:seed --force

echo "Running storage..."
php artisan storage:link


echo "Running vite..."
npm install
npm run build


