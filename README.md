**viki_crud**

## Description

Simple CRUD system for storing json objects in MySQL database. The project is the site that have two pages. To access the dashboard panel, go to registration page and create a user. 
First page is simple form to store JSON objects in database. Second page is a functional CRUD system with ADD. DELETE, UPDATE functionality. The table would show the objects that were created by authenticated user.

## Getting Started

### Dependencies

* Laravel 10
* MySQL
* Nginx

### Installing

* [Copy](https://github.com/omegarekrut/viki_crud.git) the program;
* Command `composer install`
* Command `npm install`;
* Configure `.env` file to connect the project to your DB;
* Command`php artisan migrate`
* Configure your nginx configuration on path `/etc/nginx/sites-enabled/your_config_here.conf`
Here is my configuration for [example](https://github.com/omegarekrut/viki_crud/blob/master/viki_crud.conf)

## Version History

* 0.1
    * Initial Release