php artisan passport:install


php artisan passport:client --personal


// supervisor 
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-worker:*
