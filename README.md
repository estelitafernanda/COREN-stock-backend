build:
    docker compose build

stop: 
    docker compose stop

up:
    docker compose up -d

composer-update:
    docker exec PHP-webServer bash -c "composer update"

data: 
    docker exec PHP-webServer bash -c "php artisan migrate"
    docker exec PHP-webServer bash -c "php artisan db:seed"
