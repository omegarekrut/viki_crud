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

## Table of development timeline
|  Task  |  Time  |  Spend  |  Comments  |
| Setting up Laravel                                                                                                                                                     | 10 minutes | 10 minutes    |                                                                                                                                                                                                        |
|------------------------------------------------------------------------------------------------------------------------------------------------------------------------|:----------:|:-------------:|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Create command LoginCommand.php                                                                                                                                        | 10 minutes | 15 minutes    | 5 minutes to testing it and making sure that token is valid                                                                                                                                              |
| DataController.php code with creating basic layout `resources/views`                                                                                                   | 30 minutes | 40-50 minutes | Testing functionality and refactoring it for better readability. Fixing the problems with XSRF-token in method POST. Also MySQL refuse to save column data as `json` and auto-convert it to `LONGTEXT` |
| Installing Bootstrap 5.3 with icons                                                                                                                                    | 10 minutes | 10 minutes    |                                                                                                                                                                                                        |
| Basic routing/pathing                                                                                                                                                  | 10 minutes | 10 minutes    |                                                                                                                                                                                                        |
| Creating basic form with bootstrap and applying JQuery for the basic stuff like `Confirm`, `Form-select` and `ajax-calls` to pass choosen method to DataController.php | 20 minutes | 30 minutes | Got some problems with opening textarea after reloading the page                                                                                                                                       |
| Installing DataTables and necessary libraries                                                                                                                          | 10 minutes | 10 minutes    |                                                                                                                                                                                                        |
| Creating page `crud.blade.php` and code the Datatable with configurations                                                                                              | 10 minutes | 10 minutes    |                                                                                                                                                                                                        |
| AJAX-calls for the inline-buttons Add, Delete, Edit and Index                                                                                                          | 20 minutes | 25 minutes    | 5 minutes for refactoring                                                                                                                                                                              |
| Creating DataOutputController.php for handling the AJAX-calls from frontend part                                                                                       | 30 minutes | 35 minutes    | Fixing bugs with xsrf-tokens. Trying to show the JSON data properly without `/n`                                                                                                               |
