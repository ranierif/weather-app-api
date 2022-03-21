## Weather APP API

This is a CRUD API for Weather Forecast Model build in Laravel 8.75. In this project use:

- Laravel Passport ~ to authenticate in API.
- Integration of API: [Open Weather Map](https://openweathermap.org/current).
- Cronjob to pull/store/update 4 times by day the weather data of locations pre defined.
- Queue jobs to pull weather data in database when not is stored yet.

## Installation

- Pull this project in your machine.
- Run ``` cp .env.example .env ```.
- Edit the .env archive with your data (don't forget the **OPENWEATHER_API_KEY**, this is the API KEY from Open Weather Map API).
- Run ``` composer install ```.
- Run ``` php artisan migrate ```.
- Run ``` php artisan db:seed ```
- Run ``` php artisan passport:install ```
- And start running the project ``` php artisan serve ```

## How use the API

To use the API we need a username and password, because the API is configured to be used only for authentication performed. And for this authentication I used **Laravel Passport**.

To start the tests, I created a user and a simple password in the seed:

- E-mail: api@test.com
- Password: api

To communicate with the API, you can use **POSTMAN** (don't forget to have the project running with ```php artisan serve```). Below I will list the API methods:

Go to [API Documentation (Postman)](https://documenter.getpostman.com/view/216454/UVsQrijH)

## Unit Test

- Run ```php artisan test``` or ```./vendor/bin/phpunit``` and see results of tests.
