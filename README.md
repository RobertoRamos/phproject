phproject-laravel
=================
*An experimental rebuild of Phproject on Laravel*

## Setup

Requires Composer and Yarn. Start by coping `.env.example` to `.env`, adding your database credentials. Then:

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
yarn && yarn dev
```

Set up your web server to serve the `/public` directory, and you should be good to go!
