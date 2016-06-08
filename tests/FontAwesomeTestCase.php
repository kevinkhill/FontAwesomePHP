<?php

namespace Khill\Fontawesome\Tests;

use Khill\Fontawesome\FontAwesome;

class FontAwesomeTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Khill\Fontawesome\FontAwesome
     */
    public $fa;

    public function setUp()
    {
        $this->fa = new FontAwesome();
    }
}
