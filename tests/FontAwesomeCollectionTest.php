<?php

namespace Khill\Fontawesome\Tests;

class FontAwesomeCollectionTest extends FontAwesomeTestCase
{
    public function testRetrieveDefaultStoredIconFromCollectionOutput()
    {
        $this->fa->icon('cog')->store('loginIcon');

        $this->expectOutputString('<i class="fa fa-cog"></i>');

        echo $this->fa->collection('loginIcon');
    }

    public function testRetrieveCustomStoredIconFromCollectionOutput()
    {
        $this->fa->x4('cog')->flipVertical()->store('myLabel');

        $this->expectOutputString('<i class="fa fa-cog fa-4x fa-flip-vertical"></i>');

        echo $this->fa->collection('myLabel');
    }
}
