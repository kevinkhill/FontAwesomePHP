<?php namespace Khill\Fontawesome;

use Illuminate\Support\Facades\Facade;

class FontAwesomeFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'fontawesome'; }
}
