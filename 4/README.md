## About TEST

Required
- Laravel 6.x.
- PHP >= 7.2.
- MariaDB 10.3.
- composer for php >= 7.2

### Install 
cd your local product and open cmd run
```bash
$ composer install
$ cp .env.example .env
```
Config file .env
```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1 // host mariadb
DB_PORT=3306 // your post mariadb
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
```
Create your database name and run cmd
```bash
$ php artisan migrate
$ php artisan key:generate
```
Asset to url for check: 
#### Admin:  
domain.example/admin/category   
domain.example/admin/product    
#### Front:  
domain.example

#### SRC: 
/platfor/ecommerce
