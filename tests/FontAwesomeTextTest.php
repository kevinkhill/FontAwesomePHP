<?php

namespace Khill\FontAwesome\Tests;

use Khill\FontAwesome\FontAwesome;
use Khill\FontAwesome\FontAwesomeText;

class FontAwesomeTextTest extends FontAwesomeTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorWithNoText()
    {
        $text = new FontAwesomeText();
    }

    public function testFullyLoadedTextLayer()
    {
        $this->expectOutputString('<span class="fa-layers-text fa-inverse" style="font-weight: bold;" data-fa-transform="shrink-11.5 rotate--30">NEW</span>');

        $text = new FontAwesomeText("NEW");

        echo $text->inverse()->transform("shrink", 11.5)->transform("rotate", -30)->addAttr("style", "font-weight: bold;");
    }

}
