## About

This is a repository for the tech assessment for Canoe Intelligence

## How to build

This project is on top of a Laravel application. If you are not familiar with Laravel, you can check their docs:
- [Laravel Documentation](https://laravel.com/docs/10.x/installation)

## Initial requirements

For running your environment you will need at least `PHP >= 8.1`, `Composer` and a database (we use `MySQL`) to start with. Depending on the operating system that you are running, there are multiple ways to install all three. We recommend taking a look at the following links to get started: [PHP Installation](https://www.php.net/manual/en/install.php), [Composer Installation](https://getcomposer.org/download/), [MySQL Installation](https://dev.mysql.com/doc/refman/8.0/en/installing.html).

After installing everything, make sure they are correctly working by running:
```Bash
php --version   

PHP 8.1.2 (cli) (built: Jan 24 2022 10:42:51) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.1.2, Copyright (c) Zend Technologies
    with Zend OPcache v8.1.2, Copyright (c), by Zend Technologies
    with Xdebug v3.1.2, Copyright (c) 2002-2021, by Derick Rethans
```

```Bash
composer --version    
       
Composer version 2.2.5 2022-01-21 17:25:52
```
```
mysql --version

mysql  Ver 8.0.27-0ubuntu0.21.04.1 for Linux on x86_64 ((Ubuntu))
```

### Installing dependencies & Configurations

```Bash
composer install
cp .env.example .env
php artisan key:generate
```

## Database & Migration

### ER DIAGRAM

![ER-Diagram.png](ER-Diagram.png)

### Configuration

Configure your database credentials in the .env file
````.dotenv
DB_HOST=127.0.0.1
DB_PORT=****
DB_DATABASE=canoe_test
DB_USERNAME=******
DB_PASSWORD=******
````

Run the migrations

```Bash
php artisan migrate
```

## How to serve

### Using `php artisan serve`

This is the most common way for testing a Laravel application. If you followed the steps above you just need to do the following:
```Bash
php artisan serve

 INFO  Server running on [http://127.0.0.1:8000];
```

```Bash
php artisan queue:work
```

### Testing

#### Laravel testing

This project has a few test for funds
```Bash
php artisan test

   PASS  Tests\Feature\FundControllerTest
  ✓ can get all funds                                                                                                                                                                                                        0.53s  
  ✓ can create fund                                                                                                                                                                                                          0.04s  
  ✓ can create fund with alias                                                                                                                                                                                               0.04s  
  ✓ can return duplicated funds                                                                                                                                                                                              0.06s  

  Tests:    4 passed (11 assertions)
  Duration: 0.81s

```

#### Normal testing

There is a [Canoe Test.postman_collection.json](Canoe%20Test.postman_collection.json) included in the project, import this in postman and all the queries are already written
