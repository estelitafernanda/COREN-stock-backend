build:
    docker-compose build

stop: 
    docker-compose stop

up:
    docker-compose up -d

composer:update:
    docker exec app bash -c "composer update"