<?php namespace Khill\Fontawesome;

class FontAwesomeLaravelTest extends \PHPUnit_Framework_TestCase {

    protected $FA;

    public function setUp()
    {
        $this->FA = new FontAwesome;
    }

    public function testCdnLinkOutput()
    {
        $this->expectOutputString('<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css" rel="stylesheet">');

        echo $this->FA->cdnLink();
    }

    public function testStandardIconOutputThroughConstructor()
    {
        $this->expectOutputString('<i class="fa fa-star"></i>');

        echo new FontAwesome('star');
    }

    public function testStandardIconOutputThroughIconMethod()
    {
        $this->expectOutputString('<i class="fa fa-star"></i>');

        echo $this->FA->icon('star');
    }

    public function testFixedWidthIconOutput()
    {
        $this->expectOutputString('<i class="fa fa-star fa-fw"></i>');

        echo $this->FA->fixedWidth('star');
    }

    public function testLargeIconOutput()
    {
        $this->expectOutputString('<i class="fa fa-star fa-lg"></i>');

        echo $this->FA->lg('star');
    }

}
