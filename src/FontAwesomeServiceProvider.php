<?php namespace Khill\Fontawesome;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class FontAwesomeServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        /*
         * If the package method exists, we're using Laravel 4
         */
        if (method_exists($this, 'package')) {

            $this->package('khill/fontawesome');

        }
    }

    public function register()
    {
        $this->app['fontawesome'] = $this->app->share(function($app)
        {
            return new FontAwesome();
        });

        $this->app->booting(function()
        {
            $loader = AliasLoader::getInstance();
            $loader->alias('FA', 'Khill\Fontawesome\FontAwesomeFacade');
        });
    }

    public function provides()
    {
        return array('fontawesome');
    }

}
