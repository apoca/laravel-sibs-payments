# laravel-sibs-payments
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/apoca/laravel-sibs-payments/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/apoca/laravel-sibs-payments/?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/714808179ba5410dbbadce2b3d763b64)](https://www.codacy.com/app/apoca/laravel-sibs-payments?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=apoca/laravel-sibs-payments&amp;utm_campaign=Badge_Grade)
[![Latest Stable Version](https://poser.pugx.org/apoca/laravel-sibs-payments/v/stable)](https://packagist.org/packages/apoca/laravel-sibs-payments)
[![Total Downloads](https://poser.pugx.org/apoca/laravel-sibs-payments/downloads)](https://packagist.org/packages/apoca/laravel-sibs-payments)
[![License](https://poser.pugx.org/apoca/laravel-sibs-payments/license)](https://packagist.org/packages/apoca/laravel-sibs-payments)

## Contents

- [laravel-sibs-payments](#laravel-sibs-payments)
  - [Installation](#installation)
  - [Feedback](#feedback)
  - [Contributing](#contributing)
  - [License](#license)
  - [Author](#author)
  
## Installation

Require this package with composer. It is recommended to only require the package for development.

```shell
composer require apoca/laravel-sibs-payments
```

Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

### Laravel 5.5+:

If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
Apoca\Sibs\SibsServiceProvider::class,
```

If you want to use the facade to log messages, add this to your facades in app.php:

```php
'Sibs' => Apoca\Sibs\Facade\Sibs::class,
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider="Apoca\Sibs\SibsServiceProvider"
```

## Feedback

We'd love to get feedback on how you're using lambda-resize-image and things we could add to make this tool better. Feel free to contact us at vieira@miguelvieira.com.pt

## Contributing

If you'd like to contribute to the project, feel free to submit a PR. See more: [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Author

- **Miguel Vieira** - _Initial work_ - [apoca](https://github.com/apoca)

See also the list of [contributors](https://github.com/apoca/laravel-sibs-payments/contributors) who participated in this project.