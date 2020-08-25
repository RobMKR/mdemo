## About App

Application which can import CSV data set of employees and give matching result

## How to install

1. git clone https://github.com/RobMKR/mdemo.git
2. cd mdemo
3. composer install
4. cp .env.example .env
5. php artisan key:generate
6. php artisan serve (which will run a local server at localhost:8000)

Note! Database not needed for code, so do not spent time on setting the db :)

## How to use

On homepage upload a CSV file and click Upload Button
After you will be redirected to page which is showing all matches and the total average percentage

## Notes for code
If you are not familiar with laravel,
navigate to `routes/web.php` where you can find all routes defined in application

For example line `Route::get('/employees', 'EmployeesController');` will mean that the GET Request with /employees path will be 
forwarded to `app/Http/Controllers/EmployeesController.php` file, which have only one public method and we will access it via
magic __invoke method.

All other stuff related to matching algo is living in `app/Modules/MentorMatch` path

## Credits
Made for demo purpose only
- Author: RobMKR
- Email: mkrtchyanrobert@gmail.com
- Language: PHP 7.2.24
- Framework: Laravel 7.24


