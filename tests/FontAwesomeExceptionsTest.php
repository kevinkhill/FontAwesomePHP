<?php namespace Khill\Fontawesome;

class FontAwesomeExceptionsTest extends \PHPUnit_Framework_TestCase {

    public $fa;

    public function setUp()
    {
        $this->fa = new FontAwesome();
    }

    /**
     * @dataProvider notStringProvider
     * @expectedException Khill\Fontawesome\Exceptions\BadLabelException
     */
    public function testIconMethodBadLabelException($badLabels)
    {
        $this->fa->icon($badLabels);
    }

    /**
     * @dataProvider notStringProvider
     * @expectedException Khill\Fontawesome\Exceptions\BadLabelException
     */
    public function testAddClassMethodBadLabelException($badLabels)
    {
        $this->fa->icon('star')->addClass($badLabels);
    }

    /**
     * @dataProvider notStringProvider
     * @expectedException Khill\Fontawesome\Exceptions\BadLabelException
     */
    public function testStoreIconMethodBadLabelException($badLabels)
    {
        $this->fa->icon('star')->store($badLabels);
    }


    public function notStringProvider()
    {
        return array(
            array(true),
            array(1),
            array(1.0),
            array(array()),
            array(array('test')),
            array(new \stdClass()),
            array(function(){})
        );
    }
}
