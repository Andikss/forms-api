<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# **Laravel - Forms API**

API Services for [Formify](https://github.com/Andikss/forms)

## API Setup

First of all, copy the *.env.example* file and rename it to *.env*

Then, update the composer

```bash
composer update
```

Migrate the database and seed default user

```bash
php artisan migrate
php artisan db:seed --class="UserSeeder"
```

Run the server
```bash
php artisan serve
```

Well, that's it! The API services is running 😏

## Framework & Library

- Laravel 11x
- Sanctum

## Grid (kisi-kisi)
[See Grid](public/kisi-kisi.pdf)

## Developer

[Andika Dwi Saputra](https://andikss.github.io)
