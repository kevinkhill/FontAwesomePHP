<?php

namespace Khill\FontAwesome\Tests;

use Khill\FontAwesome\FontAwesome;

class FontAwesomeTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Khill\FontAwesome\FontAwesome
     */
    public $fa;

    public function setUp()
    {
        $this->fa = new FontAwesome();
    }
}
