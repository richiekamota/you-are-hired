## About You Are Hired

You Are Hired is used by companies to contact and hire candidates. It consists of Laravel 9.11/php 8.0 backend and a Vue.js frontend running inside a Docker container. 

## Installation and setup

Clone the project above into a directory of your choice and cd into the project directory to run the following commands:

```
docker-compose up
```
```
docker exec -it you-are-hired_laravel.test_1 composer install
```
```
docker exec -it you-are-hired-test1 composer npm install
```
```
docker exec -it you-are-hired-test1 composer npm run dev
```
Run the following command (necessary for feature tests)

```
docker exec -it you-are-hired-test1 composer require doctrine/dbal
```
For migrations and database seeding

```
docker exec -it you-are-hired-test1 php artisan migrate
```
```
docker exec -it you-are-hired-test1 php artisan db:seed
```

Once the application's Docker containers have been started, you can access the application in your web browser at: http://localhost. On the home page select your company (simulated authentication and authorisation feature) before clicking the "Go to candidates list" link.

## Feature tests

For feature tests, comment out appropriate code labelled in the CandidateController and run this command

```
docker exec -it you-are-hired_laravel.test_1 php artisan test --testsuite=Feature --stop-on-failure
```