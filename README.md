# Device-Authentication Handling Package for Laravel 5.7+

This adds device authentication handling capability on a laravel backend.

## Installation Instructions

Add the private repositories in your `composer.json`.

```
    "repositories": [
        {
            "type": "vcs",
            "url": "git@bitbucket.org:elegantmedia/devices-laravel.git"
        },
        {
            "type":"vcs",
            "url":"git@bitbucket.org:elegantmedia/quickdata-laravel.git"
        },
        {
            "type": "vcs",
            "url": "git@bitbucket.org:elegantmedia/laravel-helpers.git"
        },
        {
            "type": "vcs",
            "url": "git@bitbucket.org:elegantmedia/php-helpers.git"
        }
    ],
```

Add the repository to the the application
```
composer require emedia/devices-laravel
```

The package will be auto-discovered with Laravel 5.7+

## Setup

After installation, run the setup command.
```
php artisan setup:package:devices
```

Running the command will, 

- Create the migration
- Create the seeder
- Update the routes file

Then migrate to create the tables
```
php artisan migrate
```

Seed the database
```
php artisan db:seed --class=DevicesTableSeeder
```

Or you can add it to `database/seeds/DatabaseSeeder.php`.

## Usage

After installation, you can get, set, validate and discard the token at any point of the application.

```
use EMedia\Devices\Auth\DeviceAuthenticator;

DeviceAuthenticator::getTokenByDeviceByUser($deviceId, $userId);
DeviceAuthenticator::setAccessToken($deviceId);
DeviceAuthenticator::validateAccessToken($accessToken);
DeviceAuthenticator::discardAccessToken($deviceId, $accessToken = null);
```

## Middleware

Use device authentication to validate token as a middleware, add below line to `Http\Kernel.php`. This will check for `access_token` or `token` parameters in the request and if it's present, let it through.

```
'\EMedia\Devices\Middleware\DeviceAuthMiddleware::class,'
```
