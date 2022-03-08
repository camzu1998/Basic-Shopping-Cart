## Basic Shopping Cart

A basic shopping cart is a web application made on Laravel framework.

<a href="https://wakatime.com/badge/github/camzu1998/Basic-Shopping-Cart"><img src="https://wakatime.com/badge/github/camzu1998/Basic-Shopping-Cart.svg" alt="wakatime"></a>

## Requirements
- Docker
- Composer
- Git
## Installation

git clone https://github.com/camzu1998/Basic-Shopping-Cart.git

composer update

### Docker preparation

composer require laravel/sail --dev

php artisan sail:install (choose mysql)

./vendor/bin/sail up

### Prepare database:

php artisan migrate

### To get prepared data enter:

php artisan db:seed
