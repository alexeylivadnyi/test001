#!/bin/bash

./start.sh && \
docker-compose exec php-fpm composer install && \
docker-compose exec php-fpm php artisan migrate --seed

cd ../../panel
npm install
