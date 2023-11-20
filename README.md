# About IgnitedCMS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ignitedcms/ignitedcms.svg?style=flat-square)](https://packagist.org/packages/ignitedcms/ignitedcms)
[![Total Downloads](https://img.shields.io/packagist/dt/ignitedcms/ignitedcms.svg?style=flat-square)](https://packagist.org/packages/ignitedcms/ignitedcms)
![GitHub Actions](https://github.com/ignitedcms/ignitedcms/actions/workflows/main.yml/badge.svg)

A wickedly simple Laravel CMS that is completely free to use.

## Installation
First install a fresh copy of Laravel 10, make sure you have a PHP version of 8.1 or above
and you are using MySQL.

You can install Laravel via composer:

```bash
composer create-project laravel/laravel example-app
```

Now cd into the example-app directory and install ignitedcms

```
cd example-app
 
composer require ignitedcms/ignitedcms
```

Finally, publish the assets by running

```
php artisan vendor:publish --tag=assets --force
```

## Usage

```php
// Usage description here
```

### Testing

```bash
composer test
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
