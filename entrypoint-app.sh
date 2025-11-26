#!/bin/sh
set -e

composer install

php artisan key:generate --ansi

php artisan migrate

php artisan serve --host=0.0.0.0 --port=8000
