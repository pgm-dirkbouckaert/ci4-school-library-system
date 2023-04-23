# CodeIgniter 4 School Library System

Inspired by [https://github.com/driskimaulana/library-system](https://github.com/driskimaulana/library-system)

## Installation
- Run `composer install`.
- Copy `.env-example` to `.env` and change the database and mail settings in `.env` file.
- Run `php spark migrate`.
- Start your Apache server (e.g. XAMPP) and go to the folder where you are serving this app, e.g. `http://localhost/library`.
- Note: 
    - This app can't be served with `php spark`.  It has been designed to be served in a subfolder of a shared hosting domain. It expects the path to that folder to be named `/library` but you can change that path in the `.env` file.
  - The CodeIgniter localization tool has been used to serve the app in the Dutch language. A basic English translation of the library system has been provided, however not been tested. Change the `defaultLocale` in `app\Config\App.php` to `en` to switch to English. 
  - For authentication `myth-auth` has been added to the `app\ThirdParty` folder. More information at [https://github.com/lonnieezell/myth-auth](https://github.com/lonnieezell/myth-auth)

