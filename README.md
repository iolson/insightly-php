# Insightly CRM PHP Client

[![Latest Version](https://img.shields.io/github/release/iolson/insightly-php.svg)](https://github.com/iolson/insightly-php/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/iolson/insightly-php/master.svg)](https://travis-ci.org/iolson/insightly-php)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/b8ee47a2-d70c-4bf6-bae9-e0adbfdca4bd.svg?maxAge=2592000)](https://insight.sensiolabs.com/projects/b8ee47a2-d70c-4bf6-bae9-e0adbfdca4bd)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/iolson/insightly-php.svg)](https://scrutinizer-ci.com/g/iolson/insightly-php/)
[![Quality Score](https://img.shields.io/scrutinizer/g/iolson/insightly-php.svg)](https://scrutinizer-ci.com/g/iolson/insightly-php)
[![Total Downloads](https://img.shields.io/packagist/dt/iolson/insightly-php.svg)](https://packagist.org/packages/iolson/insightly-php)

A comprehensive PHP library for [Insightly CRM](https://www.insightly.com)

This package is supported by Ian Olson and is not affiliated with [Insightly CRM](https://www.insightly.com). The package requires PHP 5.5.9+ and follows the FIG standards PSR-1, PSR-2 and PSR-4 to ensure a high level of interoperability between shared PHP developers.

## Install

Via Composer

```bash
$ composer require iolson/insightly-php
```

## Usage

Coming Soon!

## Testing

Test suite, include integration testing, and requires a valid API key for Insightly CRM.

1. Create a FREE account at [Insightly CRM](https://www.insightly.com).
2. Login and Goto `User Settings`.
3. Copy your `API KEY`.

``` bash
$ INSIGHTLY_API_KEY=<API KEY> ./vendor/bin/phpunit
```

By default the tests will send live HTTP requests to the Inisghtly CRM API. If you are without internet connection you can skip these tests by excluding the `integration` group.

```bash
$ ./vendor/bin/phpunit --exclude-group integration
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Ian Olson](https://github.com/iolson)
- [All Contributors](https://github.com/iolson/insightly-php/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
