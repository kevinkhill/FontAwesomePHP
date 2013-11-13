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
    public function testIconMethodThrowsBadLabelException($badLabels)
    {
        $this->fa->icon($badLabels);
    }

    /**
     * @dataProvider notStringProvider
     * @expectedException Khill\Fontawesome\Exceptions\BadLabelException
     */
    public function testAddClassMethodThrowsBadLabelException($badLabels)
    {
        $this->fa->icon('star')->addClass($badLabels);
    }

    /**
     * @dataProvider notStringProvider
     * @expectedException Khill\Fontawesome\Exceptions\BadLabelException
     */
    public function testStoreIconMethodThrowsBadLabelException($badLabels)
    {
        $this->fa->icon('star')->store($badLabels);
    }

    /**
     * @expectedException Khill\Fontawesome\Exceptions\CollectionIconException
     */
    public function testRetrieveStoredIconMethodThrowsCollectionIconException()
    {
        $this->fa->collection('iDontExist');
    }

    /**
     * @expectedException Khill\Fontawesome\Exceptions\IncompleteStackException
     */
    public function testCallingOnMethodBeforeStackMethodThrowsIncompleteStackException()
    {
        $this->fa->on('twitter');
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
