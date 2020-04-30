## Installation Instructions

Follow these steps to install the application:

- Create a database on phpMyAdmin
- Create a new file in the root folder. Name it '**.env**'
- Copy everyting in '**.env.example**' and paste the code into '**.env**'
- Open '**.env**' and set the *DB_DATABASE*, *DB_USERNAME*, and *DB_PASSWORD* to the database you created.

Then open a terminal window in the application folder or cd into it. Run the following in your command line:
- `composer install`
- `php artisan key:generate`
- `npm install`
- `php artisan migrate`
- `php artisan db:seed`
- `php artisan passport:install`
- `php artisan storage:link`
- `php artisan serve`