FontAwesomePHP
==============
[![Build Status](https://travis-ci.org/kevinkhill/FontAwesomePHP.png?branch=1.0)](https://travis-ci.org/kevinkhill/FontAwesomePHP)
[![Coverage Status](https://coveralls.io/repos/kevinkhill/FontAwesomePHP/badge.png)](https://coveralls.io/r/kevinkhill/FontAwesomePHP)

A composer ready package designed to integrate the fantastic Font Awesome icon set into your PHP projects through an easy to use interface.

Created with Laravel in mind, a ServiceProvider and Facade have been included as well. Don't worry though, the library will work in any PHP application, via composer or manually.

Install
=======
First, add the package to your main composer.json file:

```json
"khill/fontawesomephp" : "~1.0"
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
