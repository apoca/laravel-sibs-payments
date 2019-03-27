# laravel-sibs-payments
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/954f2d4ccbef401099ddc63ef6e824de)](https://app.codacy.com/app/apoca/laravel-sibs-payments?utm_source=github.com&utm_medium=referral&utm_content=apoca/laravel-sibs-payments&utm_campaign=Badge_Grade_Dashboard)
[![Build Status](https://travis-ci.org/apoca/laravel-sibs-payments.svg?branch=master)](https://travis-ci.org/apoca/laravel-sibs-payments)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/apoca/laravel-sibs-payments/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/apoca/laravel-sibs-payments/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/apoca/laravel-sibs-payments/v/stable)](https://packagist.org/packages/apoca/laravel-sibs-payments)
[![Total Downloads](https://poser.pugx.org/apoca/laravel-sibs-payments/downloads)](https://packagist.org/packages/apoca/laravel-sibs-payments)
[![License](https://poser.pugx.org/apoca/laravel-sibs-payments/license)](https://packagist.org/packages/apoca/laravel-sibs-payments)

Laravel library to communicate with [SIBS - Open Payment Platform](https://www.sibs-international.com/). The library includes payments: VISA, MASTER, AMEX, VPAY, MAESTRO, VISADEBIT, VISAELECTRON.

## Contents

- [laravel-sibs-payments](#laravel-sibs-payments)
  - [Installation](#installation)
  - [Usage](#usage)
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

If you want to use the facade, add this to your facades in app.php:

```php
'Sibs' => Apoca\Sibs\Facade\Sibs::class,
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider="Apoca\Sibs\SibsServiceProvider"
```

## Usage

Sending the request parameters server-to-server and receive the payment response synchronously.

```php
$request = [
    'amount' => 102.34,
    'currency' => 'EUR',
    'brand' => 'VISA',
    'type' => 'DB',
    'number' => 4200000000000000,
    'holder' => 'Jane Jones',
    'expiry_month' => 05,
    'expiry_year' => 2020,
    'cvv' => 123,
];
$response = Sibs::checkout($request)->pay();
```

#### Response

```JSON
{
  "status": 200,
  "response": {
    "id":"8ac7a4a26982228701698db398cf05ee",
      "paymentType":"DB",
      "paymentBrand":"VISA",
      "amount":"102.34",
      "currency":"EUR",
      "descriptor":"2302.8463.4825 OPP_Channel ",
      "result":{
        "code":"000.100.110",
        "description":"Request successfully processed in 'Merchant in Integrator Test Mode'"
      },
      "card":{
        "bin":"420000",
        "last4Digits":"0000",
        "holder":"Jane Jones",
        "expiryMonth":"05",
        "expiryYear":"2020"
      },
      "risk":{
        "score":"100"
      },
      "buildNumber":"699e422a79444128a09e7d5d75eb187a99e8b3f3@2019-03-15 04:42:21 +0000",
      "timestamp":"2019-03-17 22:09:12+0000",
      "ndc":"8a8294185332bbe601533754724914d9_db6237eaf4b247ca99e4f917c5ca2943"
  }
}
```

[See oficial SIBS api reference](https://sibs.docs.onlinepayments.pt/)

## Feedback

We'd love to get feedback on how you're using lambda-resize-image and things we could add to make this tool better. Feel free to contact us at vieira@miguelvieira.com.pt

## Contributing

If you'd like to contribute to the project, feel free to submit a PR. See more: [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Author

- **Miguel Vieira** - _Initial work_ - [apoca](https://github.com/apoca)

See also the list of [contributors](https://github.com/apoca/laravel-sibs-payments/contributors) who participated in this project.