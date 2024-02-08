# About IgnitedCMS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ignitedcms/ignitedcms.svg?style=flat-square)](https://packagist.org/packages/ignitedcms/ignitedcms)
[![Total Downloads](https://img.shields.io/packagist/dt/ignitedcms/ignitedcms.svg?style=flat-square)](https://packagist.org/packages/ignitedcms/ignitedcms)
![GitHub Actions](https://github.com/ignitedcms/ignitedcms/actions/workflows/main.yml/badge.svg)

A  simple Laravel CMS that is completely free to use.

## Installation
First install a fresh copy of Laravel 10, make sure you have a PHP version of 8.1 or above
and you are using MySQL. (We strongly advise to ONLY use this with a fresh install!)

You can install Laravel via composer:

```bash
composer create-project laravel/laravel example-app
```

Now cd into the example-app directory and install ignitedcms

```
cd example-app
```
Run composer
 
```
composer require ignitedcms/ignitedcms
```

Finally, publish the assets by running, do NOT skip this step!

```
php artisan vendor:publish --tag=assets --force
php artisan vendor:publish --tag=config --force
php artisan vendor:publish --tag=views --force
```

Now that you have done that create a fresh database called
'ignitedcms' and change the settings in your .env file
so it points to your database e.g

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ignitedcms
DB_USERNAME=root
DB_PASSWORD=root
```

Run the migrations
```
php artisan migrate
```


Finally run
```
php artisan serve
```

## Usage
Navigate to and begin the install
```
http://localhost:8000/installer
```

To access the dashboard navigate to

```
http://localhost:8000/login
```


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email fernandes_craig@hotmail.com instead of using the issue tracker.

## Credits

-   [IgnitedCMS](https://github.com/ignitedcms)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
