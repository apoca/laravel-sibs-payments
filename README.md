# laravel-sibs-payments
[![Build Status](https://travis-ci.org/apoca/laravel-sibs-payments.svg?branch=master)](https://travis-ci.org/apoca/laravel-sibs-payments)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/e7fe68a20a624d4084050449d23135a4)](https://www.codacy.com/app/apoca/laravel-sibs-payments?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=apoca/laravel-sibs-payments&amp;utm_campaign=Badge_Grade)
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

### COPYandPAY Integration Guide

1. Prepare the checkout

First, perform a server-to-server POST request to prepare the checkout with the required data, including the order type, amount and currency. The response to a successful request is a JSON string with an id, which is required in the second step to create the payment form.

```php
$request = [
    'brand' => 'CHECKOUT',
    'amount' => 100,
    'currency' => 'EUR',
    'type' => 'DB',
    'optionalParameters' => [],
];

$response = Sibs::checkout($request)->pay();
```

#### Response

```JSON
{
  "status": 200,
  "response": {
    "result":{
        "code":"000.200.100",
        "description":"successfully created checkout"
      },
      "buildNumber":"0dbf5028d176bc143baf9657d4d786f6372f4a83@2019-03-29 10:03:17 +0000",
      "timestamp":"2019-03-29 11:27:15+0000",
      "ndc":"E45186C4789C89A23E66D8DDA57A8586.uat01-vm-tx01",
      "id":"E45186C4789C89A23E66D8DDA57A8586.uat01-vm-tx01"
  }
}
```

2. Create the payment form

- The checkout's id that you got in the response from step 1

```HTML
<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={response->id}"></script>
```

- The shopperResultUrl, which is the page on your site where the customer should be redirected to after the payment is processed and the brands that will be available.

```HTML
<form action="{shopperResultUrl}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
```

3. Get the payment status (see step 1)

```
$response = Sibs::status($response->response->id);
```

```JSON
{
  "status": 400,
  "response": {
    "result":{
        "code":"200.300.404",
        "description":"invalid or missing parameter",
        "parameterErrors": [
          {
            "name": "entityId",
            "value": "8a8294185332bbe601533754724914d9",
            "message": "is not an allowed parameter"
          }
        ]
      },
      "buildNumber":"",
      "timestamp":"2019-03-29 11:27:15+0000",
      "ndc":"89C42801E79302B0E75520C4A793121D.uat01-vm-tx03"
  }
}
```

NOTE: You'll receive and error code 400, because you need an entity key approved by [sibs](https://www.sibs-international.com/).

### Server-to-Server

Sending the request parameters server-to-server and receive the payment response synchronously. 
NOTE: This integration variant requires you to collect the card data which increases your PCI-compliance scope. If you want to minimize your PCI-compliance requirements, we recommend that you use COPYandPAY.

You can perform different types of initial payments using our server-to-server REST API.

- Preauthorization (PA)
- Debit (DB)

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
    'optionalParameters' => [],
];
$response = Sibs::checkout($request)->pay();
```

### Asynchronous Server-to-Server MBWay
In an asynchronous workflow a redirection takes place to allow the account holder to complete/verify the payment.<br/>
Put the brand parameter equals to "MBWAY" and the type equals to PA. The accountId should be a phone number like this <country_dial_code#phone_number>.
```php
$request = [
    'amount' => 10.44,
    'currency' => 'EUR',
    'brand' => 'MBWAY',
    'type' => 'PA',
    'accountId' => '351#911222111',
    'optionalParameters' => [],
];
$response = Sibs::checkout($request)->pay();
```

If you are in test mode put the mode parameter on sibs config file equals to test.
#### Response Example

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

We'd love to get feedback on how you're using laravel-sibs-payments and things we could add to make this tool better. Feel free to contact us at vieira@miguelvieira.com.pt

## Contributing

We'd love to get feedback on how you're using *laravel-sibs-payments* and things we could add to make this tool better. Feel.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Author

- **Miguel Vieira** - _Initial work_ - [apoca](https://github.com/apoca)

See also the list of [contributors](https://github.com/apoca/laravel-sibs-payments/contributors) who participated in this project.