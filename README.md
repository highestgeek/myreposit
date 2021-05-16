# manycom simple ecommerce cart with paypal payment gateway integration.

## About Repository

manycom simple ecommerce cart based on Laravel 8 using paypal rest sdk payment gateway. 

## Tech Specification

- Laravel 8
- PayPal rest sdk
- Bootstrap 5 + Font Awesome 5 and jQuery.

## Features

- Basic ecommerce cart system
- Login, Register, as default auth
- Payment with paypal
- Authorization

## Installation

- `git clone https://github.com/SBTHDR/manycom.git`
- `cd manycom/`
- `cp .env.example .env`
- `composer install`
- Run `php artisan key:generate`
- Update `.env` and set your database credentials
- Update `.env` with your paypal key
- `php artisan migrate`
- `npm install`
- `npm run dev`
- `php artisan serve`

## License

[MIT license](https://opensource.org/licenses/MIT).