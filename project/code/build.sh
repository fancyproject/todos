#!/bin/bash

composer install -o
php artisan route:cache
php artisan migrate
php artisan db:seed --class=AddUserSeeder
php artisan receive:todos
