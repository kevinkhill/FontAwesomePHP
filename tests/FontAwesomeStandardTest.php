<?php namespace Khill\Fontawesome;

class FontAwesomeStandardTest extends \PHPUnit_Framework_TestCase {

    public $fa;

    public function setUp()
    {
        $this->fa = new FontAwesome;
    }

    public function testCdnLinkOutput()
    {
        $this->expectOutputString('<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css" rel="stylesheet">');

        echo FontAwesome::cdnLink();
    }

    public function testStandardIconOutputThroughConstructor()
    {
        $this->expectOutputString('<i class="fa fa-star"></i>');

        echo new FontAwesome('star');
    }

    public function testStandardIconOutputThroughIconMethod()
    {
        $this->expectOutputString('<i class="fa fa-star"></i>');

        echo $this->fa->icon('star');
    }

    public function testFixedWidthIconOutput()
    {
        $this->expectOutputString('<i class="fa fa-star fa-fw"></i>');

        echo $this->fa->fixedWidth('star');
    }

    public function testFixedWidthIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fa fa-star fa-fw"></i>');

        echo $this->fa->icon('star')->fixedWidth();
    }

    public function testLargeIconOutput()
    {
        $this->expectOutputString('<i class="fa fa-star fa-lg"></i>');

        echo $this->fa->lg('star');
    }

    public function testLargeIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fa fa-star fa-lg"></i>');

        echo $this->fa->icon('star')->lg();
    }

}
