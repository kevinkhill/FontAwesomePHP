<?php

namespace Khill\FontAwesome\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * FontAwesomePHP Laravel Facade
 *
 * @package   Khill\FontAwesome
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesomeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fontawesomephp';
    }
}
