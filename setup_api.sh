#!/bin/sh

sleep 10
php artisan migrate -n

php artisan serve --host=0.0.0.0 --port=$PORT