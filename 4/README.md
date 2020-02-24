## About TEST

Required
- Laravel 6.x.
- PHP >= 7.2.
- MariaDB 10.3.
- composer for php >= 7.2

####Install 
cd your local product and open cmd run
```bash
$ composer install
$ cp .env.example .env
```
File .env
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=
```
Create your database name and run
```bash
$ php artisan migrate
$ php artisan key:generate
```
Asset to url for check:
#####Admin:  
domain.example/admin/category   
domain.example/admin/product
#####Front:  
domain.example
