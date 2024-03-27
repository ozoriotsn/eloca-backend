# Eloca Backend Test

## Project setup

Requisites:

PHP V8.1 +

LARAVEL V10.10

MYSQL V5.7

### Install dependencies and build laravel app
set configuration of database in .env file

next step

```
composer install
php artisan migrate
php artisan db:seed


```
### Generate API DOC
```
php artisan scribe:generate
```
Access api endpoint/docs

http://127.0.0.1:8000/docs

### Run os develop server php
```
php artisan serve

```
Endpoint for api

http://127.0.0.1:8000/api
