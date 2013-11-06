<?php namespace Khill\Fontawesome;

class FontAwesomeTest extends \PHPUnit_Framework_TestCase {

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

    public function testIconOutput()
    {
        $this->expectOutputString('<i class="fa fa-star"></i>');

        echo $this->FA->icon('star');
    }

}
