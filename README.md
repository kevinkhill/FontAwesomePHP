FontAwesome for PHP
===================
[![Total Downloads](https://img.shields.io/packagist/dt/khill/FontAwesomePHP.svg?style=plastic)](https://packagist.org/packages/khill/FontAwesomePHP)
[![License](https://img.shields.io/packagist/l/khill/FontAwesomePHP.svg?style=plastic)](http://opensource.org/licenses/MIT)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg?style=plastic)](https://php.net/)
[![PayPayl](https://img.shields.io/badge/paypal-donate-yellow.svg?style=plastic)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FLP6MYY3PYSFQ)

[![Current Release](https://img.shields.io/github/release/kevinkhill/FontAwesomePHP.svg?style=plastic)](https://github.com/kevinkhill/FontAwesomePHP/releases)
[![Build Status](https://img.shields.io/travis/kevinkhill/FontAwesomePHP/1.0.svg?style=plastic)](https://travis-ci.org/kevinkhill/FontAwesomePHP)
[![Coverage Status](https://img.shields.io/coveralls/kevinkhill/FontAwesomePHP/1.0.svg?style=plastic)](https://coveralls.io/r/kevinkhill/FontAwesomePHP?branch=1.0)

A composer ready package designed to integrate the fantastic Font Awesome icon set into your PHP projects through an easy to use interface.

Created with Laravel in mind, a ServiceProvider and Facade have been included as well. Don't worry though, the library will work in any PHP application, via composer or manually.

Install
=======
First, add the package to your main composer.json file:

```json
"khill/fontawesomephp" : "1.0.*"
```

Next, run composer from the command line to download and install:

```bash
$ composer update
```

Then, if you are using Laravel, add the ServiceProvider to the service providers array in the app.php file:

```php
'Khill\Fontawesome\FontAwesomeServiceProvider' //Skip this step if you are not using Laravel
```

Last, add the link in your view's page header to the FontAwesome CSS file, provided by BootstrapCDN:

```php
FontAwesome::css() // Or FA::css() if you want to use the alias
```

Examples and Api
================
Please visit [FontAwesomePHP](http://kevinkhill.github.io/FontAwesomePHP) for a complete list of features, examples and the api.
