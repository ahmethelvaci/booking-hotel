# Booking Hotel Sample Application

## Installation

Sail : https://laravel.com/docs/11.x/sail

#### Clone git repo
```bash
git clone https://github.com/ahmethelvaci/booking-hotel.git
cd booking-hotel
```

#### Run composer install with laravelsail/php83-composer container
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

#### Copy .env.example file to .env

#### Create docker images
```bash
./vendor/bin/sail up
```

#### Create Tables and Seed
```bash
./vendor/bin/sail up artisan migrate:fresh --seed
```

## Endpoints 
Postman Documenter : [https://documenter.getpostman.com/view/834718/2sAYBUDsco]
