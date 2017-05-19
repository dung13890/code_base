# About Base Laravel v5.4.x

Code base with Api application and Web application

- [x] Design pattern
- [x] Authenticate with passport
- [x] Permission with policies
- [x] Dependencies with bower & npm
- [x] Yajra/Datatables

You can sign in with account demo

>   # http://domain.com/login
>    account: admin/secret

## Required

 - Git
 - Composer
 - PHP v.7.x
 - MySql v.5.7.x
 - Node
 - Npm
 - bower
 - webpack

## Setup for project with Api

```sh
$ git clone git@github.com:dung13890/code_base.git
$ cd project
$ composer install --no-scripts
$ cp .env.example .env
$ php artisan key:generate
```

## Setup for project with Web application

```sh
$ git clone git@github.com:dung13890/code_base.git
$ cd project
$ composer install --no-scripts
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
