#!/bin/sh

### Build node
cd ./hatonet-client && npm install && npm run build && pm2 delete npm && pm2 start npm -- start



docker exec -it hatonet-laravel chmod -R 777 storage
docker exec -it hatonet-laravel php artisan migrate:fresh --seed