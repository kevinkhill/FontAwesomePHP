<?php

namespace Khill\FontAwesome\Tests;

use Khill\FontAwesome\FontAwesome;

class FontAwesomeExceptionsTest extends FontAwesomeTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBadInputForIconOutputThroughConstructor()
    {
        echo new FontAwesome(12);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIconWithInvalidCustomAttribute()
    {
        echo $this->fa->fixedWidth('star')->addAttr(9.81, 'Tooltips!');
        echo $this->fa->fixedWidth('star')->addAttr('id', 9.81);
    }
}
