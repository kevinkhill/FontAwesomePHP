<?php namespace Khill\FontAwesome;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class FontAwesomeServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {
        $this->package('khill/fontawesome');

        include __DIR__.'/../../routes.php';
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
            $loader->alias('FontAwesome', 'Khill\FontAwesome\FontAwesomeFacade');
        });
    }

    public function provides()
    {
        return array('fontawesome');
    }

}
