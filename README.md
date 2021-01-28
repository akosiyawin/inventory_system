<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel">
</a>
<a href="https://vuejs.org" target="_blank">
<img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo">
</a>
</p>


# Inventory System &middot; [![Packagist](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/framework) [![Build Status](https://img.shields.io/travis/npm/npm/latest.svg?style=flat-square)](https://travis-ci.org/npm/npm) [![npm](https://img.shields.io/npm/v/npm.svg?style=flat-square)](https://www.npmjs.com/package/npm) [![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com) [![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/your/your-project/blob/master/LICENSE)

> A simple and Dynamic Inventory System.

This is a project created by the students of <a href="https://www.facebook.com/EPCST">Eastwoods Professional College of Science and Technology</a>, they are a student
under 3rd Year, BS Computer Science. This project is a requirement for the subject Object-Oriented Programming. 

This is a dynamic inventory system that you can use for keeping track of records of any items.
The application has a several features including Login system, Create & Manage Product or Category,
and a Dashboard that you can use to view the summary records of your inventory.

## Features of Application

### Login
<a href="https://ibb.co/stzR8w0"><img src="https://i.ibb.co/QXtQyN2/Login.png" alt="Login" border="0"></a>

### Dashboard
<a href="https://ibb.co/9GcFPzV"><img src="https://i.ibb.co/yVdw2GY/Dashboard.png" alt="Dashboard" border="0"></a>

### Create Product
<a href="https://ibb.co/P6hbpXD"><img src="https://i.ibb.co/qrs4GqJ/Create-Product.png" alt="Create-Product" border="0"></a>

### View & Manage Product
<a href="https://ibb.co/JsTKBKP"><img src="https://i.ibb.co/2krynyB/Products.png" alt="Products" border="0"></a>

### View & Manage Category
<a href="https://ibb.co/sFByRnz"><img src="https://i.ibb.co/0fwh2Tv/Manage-Category.png" alt="Manage-Category" border="0"></a>


## Installing / Getting started

A quick introduction of the minimal setup you need to get the project up and running.

### Package Setup
```shell
composer install
```

Install all required package of composer to get the application working.

```shell
npm install && npm run dev
```

Install all required package of npm and serve the application as development.

### Database Setup

```mysql
create database school_invetory_system
```

Create a database for migration of the application.

```shell
php artisan migrate
```

Apply the migration of the application. This will create all the required tables on your database.

### Running the Application

```shell
php artisan serve
```

Final Step, This will run the application on your localhost, make sure to enable your Wamp, Xampp or any localhost 
Server that you have.

### Login to the Application using this credential

> **Email:** ```admin@admin.com```
> 
> **Password:** ```admin```

## Developing

### Built With
Laravel and Vue Js 

### Prerequisites
Make sure that you have an NPM and Composer install on your computer.

## Database

This project uses MySQl as a database, But you are not limited to this, as you can also use PostgreSQL
as a database for this application.

## Licensing


This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).

