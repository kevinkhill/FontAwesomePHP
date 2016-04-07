<?php

namespace Khill\Fontawesome\Tests;

use Khill\Fontawesome\FontAwesome;

class FontAwesomeTestCase extends \PHPUnit_Framework_TestCase
{
    public $fa;

    public function setUp()
    {
        $this->fa = new FontAwesome();
    }
}
