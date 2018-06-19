FontAwesome 5 for PHP
===================
[![Total Downloads](https://img.shields.io/packagist/dt/khill/FontAwesomePHP.svg?style=plastic)](https://packagist.org/packages/khill/FontAwesomePHP)
[![License](https://img.shields.io/packagist/l/khill/FontAwesomePHP.svg?style=plastic)](http://opensource.org/licenses/MIT)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg?style=plastic)](https://php.net/)

[![Current Release](https://img.shields.io/github/release/kevinkhill/FontAwesomePHP.svg?style=plastic)](https://github.com/kevinkhill/FontAwesomePHP/releases)
[![Build Status](https://img.shields.io/travis/kevinkhill/FontAwesomePHP/2.0.svg?style=plastic)](https://travis-ci.org/kevinkhill/FontAwesomePHP)
[![Coverage Status](https://img.shields.io/coveralls/kevinkhill/FontAwesomePHP/2.0.svg?style=plastic)](https://coveralls.io/r/kevinkhill/FontAwesomePHP?branch=2.0)

A composer ready package designed to integrate the fantastic Font Awesome icon set into your PHP projects through an easy to use interface.

Created with Laravel in mind, a ServiceProvider and Facade have been included as well. Don't worry though, the library will work in any PHP application, via composer or manually.

> If you would like to use FontAwesome 4 then use the `1.1` branch

Install
=======
First, add the package to your main composer.json file:

```json
"khill/fontawesomephp" : "2.0.*"
```

Next, run composer from the command line to download and install:

```bash
$ composer update
```

If you are using Laravel, add the ServiceProvider to the service providers array
```php
'Khill\FontAwesome\Laravel\FontAwesomeServiceProvider'
```

Last, add the link in your view's page header to the FontAwesome CSS or JS file, provided by the FontAwesome CDN:

```php
FontAwesome::css() // Or FA::css() if you want to use the alias
```

```php
FontAwesome::js() // Or FA::js() if you want to use the alias
```

If you have a FontAwesome Pro license, add `true` to the CDN methods to request
the Pro assets (make sure you've [whitelisted your domains](https://fontawesome.com/account/services) first):

```php
FontAwesome::js(true) // Or FA::js(true) if you want to use the alias
```

Examples and Api
================
Please visit [FontAwesomePHP](http://kevinkhill.github.io/FontAwesomePHP) for a complete list of features, examples and the api.
