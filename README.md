# PHP Library for the Lazada Open Platform (untested)
PHP library for the new Lazada Open Platform, written based on the [new API reference](https://open.lazada.com/doc/api.htm).

## ⚠️ Status: Probably Broken ⚠️
Only the following parts of the library are available:
- Authentication
- Exception Handling & Validation
- Http & Http Client
- Object -> Orders

The following are pending development:
- Object -> Product
- Object -> Finance
- Object -> Logistics
- Object -> Seller
- Object -> System
- Object -> DataMoat

The full version of this library will be available on 24th June 2018.

## Composer Installation
You can install the bindings via Composer. Run the following command:

```bash
composer require theroyalstudent/lazada-openplatform-php
```

To use the bindings, use Composer's autoload:

```php
require_once('vendor/autoload.php');
```

## Documentation
See [Lazada Open Platform API Reference](https://open.lazada.com/doc/api.htm) for up-to-date documentation, and [Seller Authorization Intro](https://open.lazada.com/doc/doc.htm#?nodeId=10434&docId=108260) for more information about the OAuth2.0-based authorization protocol put in place.

## Contributing
Please feel free to make open an issue if you encounter any issue with the library, or make a pull request if you've improved upon my library!

## Licenses

Copyright (C) 2018 [Edwin A.](https://theroyalstudent.com) \<edwin@theroyalstudent.com\>

This work is licensed under the Creative Commons Attribution-ShareAlike 3.0

Unported License: http://creativecommons.org/licenses/by-sa/3.0/