# About Base Laravel v5.4.x

[![Build Status](https://api.travis-ci.org/dung13890/code_base.svg)](https://travis-ci.org/dung13890/code_base)

Code base with Api application and Web application

I use docker [shincoder/homestead](https://hub.docker.com/r/shincoder/homestead) && [mariadb](https://hub.docker.com/_/mariadb)

- [x] Design pattern
- [x] Use Mysql or mongodb
- [x] Authenticate with passport
- [x] Permission with policies
- [x] Yajra/Datatables
- [x] Dependencies with bower & npm
- [x] Use Laravel mix compiling assets

You can sign in with account demo

>   # http://domain.com/login
>    account: admin@example.com/secret

## Required

 - Git
 - Composer
 - PHP v.7.x
 - MySql v.5.7.x
 - Node
 - Npm
 - bower
 - webpack

## Setup for project with Mongodb

Make sure you have the MongoDB PHP driver installed. You can find installation instructions at 
[http://php.net/manual/en/mongodb.installation.php](http://php.net/manual/en/mongodb.installation.php)

```sh
$ git clone git@github.com:dung13890/code_base.git
$ cd project
$ composer install --no-scripts
$ cp .env.mongo .env
$ php artisan key:generate
$ php artisan db:seed --class=UsersMongoSeeder
```
In `App\Providers\RepositoryServiceProvider` Change singleton Mongo instead of Mysql

## Setup for project with Api

```sh
$ git clone git@github.com:dung13890/code_base.git
$ cd project
$ composer install --ignore-platform-reqs --no-interaction
$ cp .env.example .env
$ php artisan key:generate
```

## Setup for project with Web application

```sh
$ git clone git@github.com:dung13890/code_base.git
$ cd project
$ composer install --ignore-platform-reqs --no-interaction
$ npm install
$ bower install
$ cp .env.example .env
$ php artisan key:generate
```

## Create Database 

```sh
$ mysql -u username -psecret

mysql> create database laravel_db;
mysql> exit;
```
## Config environment
$ vim .env

Change DB_DATABASE, DB_USERNAME and DB_PASSWORD

## Migrate && seed data factories

```sh
$ php artisan migrate:refresh --seed
```

## Start API application

```sh
# Setup passport run only once
$ php artisan passport:install

# Creating A Password Grant Client
$ php artisan passport:client --password

# Copy API_CLIENT_SECRET and API_CLIENT_id To .env
```

## Start web application production

```sh
$ npm run production
```

## Start web application Dev

```sh
$ npm run dev or $ npm run watch
```

## Test

```sh
$ ./vendor/bin/phpunit
```
