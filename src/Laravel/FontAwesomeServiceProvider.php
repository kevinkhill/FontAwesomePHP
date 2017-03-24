<?php

namespace Khill\FontAwesome\Laravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Khill\FontAwesome\FontAwesome;

/**
 * FontAwesomePHP Laravel Service Provider
 *
 * @package   Khill\FontAwesome
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesomeServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        /*
         * If the package method exists, we're using Laravel 4
         */
        if (method_exists($this, 'package')) {
            $this->package('khill/fontawesomephp');
        }
    }

    public function register()
    {
        $this->app->singleton('fontawesomephp', function($app){
            return new FontAwesome();
        });

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('FA', 'Khill\FontAwesome\Laravel\FontAwesomeFacade');
        });
    }

    public function provides()
    {
        return array('fontawesomephp');
    }
}
