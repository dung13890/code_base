# About Base Laravel

## Required

 - Git
 - Composer
 - PHP v.7.x
 - MySql v.5.7.x
 - Node
 - Npm
 - bower
 - webpack

## Setup for project

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

## Start production

```sh
$ php artisan migrate:refresh --seed
$ npm run production
```

## Start Dev

```sh
$ php artisan migrate:refresh --seed
$ npm run dev or $ npm run watch
```

## Test

```sh
$ phpunit
```
