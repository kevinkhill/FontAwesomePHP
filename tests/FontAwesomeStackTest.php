<?php namespace Khill\Fontawesome;

class FontAwesomeStackTest extends \PHPUnit_Framework_TestCase {

    public $fa;

    public function setUp()
    {
        $this->fa = new FontAwesome();
    }

    public function testBasicStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic');
    }

    public function testLargeStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-lg"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->lg();
    }

}
