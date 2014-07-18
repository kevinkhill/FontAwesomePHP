FontAwesomePHP
==============
[![Build Status](https://travis-ci.org/kevinkhill/FontAwesomePHP.png?branch=master)](https://travis-ci.org/kevinkhill/FontAwesomePHP)
[![Coverage Status](https://coveralls.io/repos/kevinkhill/FontAwesomePHP/badge.png)](https://coveralls.io/r/kevinkhill/FontAwesomePHP)

A composer ready package designed to integrate the fantastic Font Awesome icon set into your PHP projects through an easy to use interface.

Created with Laravel in mind, a ServiceProvider and Facade have been included as well. Don't worry though, the library will work in any PHP application, via composer or manually.

Install
=======
First, add the package to your main composer.json file:

```
"khill/fontawesomephp" : "1.0.x"
```

Next, run composer from the command line to download and install:

```
composer update
```

Then, if you are using Laravel, add the ServiceProvider to the service providers array in the app.php file:

```
'Khill\Fontawesome\FontAwesomeServiceProvider' //Skip this step if you are not using Laravel
```

Last, add the link in your view's page header to the FontAwesome CSS file, provided by BootstrapCDN:

```
FontAwesome::css() // Or FA::css() if you want to use the alias
```

Examples and Api
================
Please visit [FontAwesomePHP](http://kevinkhill.github.io/FontAwesomePHP) for a complete list of features, examples and the api.


Like My Work?
=============
Feel like buying me a coffee? [Any amount donated to is greatly apprecieated :)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=FLP6MYY3PYSFQ)

- - -

##[MIT License](http://opensource.org/licenses/MIT)
```
Copyright (c) 2013, Kevin Hill of KHill Designs

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.
```
