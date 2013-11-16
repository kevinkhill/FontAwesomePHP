<?php namespace Khill\Fontawesome;

use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;
use Khill\Fontawesome\Exceptions\IncompleteStackException;

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
    public function testStoredIncompleteIconThrowsCollectionIconException()
    {
        $this->fa->store('iDontExist');
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

//    public function testCallingStackMethodWithoutOnMethodThrowsIncompleteStackException()
//    {
//        $this->fa->stack('github');
//    }


    public function testBadLabelExceptionOutput()
    {
        $this->expectOutputString('Khill\Fontawesome\Exceptions\BadLabelException: [ERROR] Icon label must be a string.'."\n");

        try {
            $this->fa->icon(2);            
        } catch(BadLabelException $e) {
            echo $e;
        }
    }

    public function testCollectionIconExceptionOutput()
    {
        $this->expectOutputString('Khill\Fontawesome\Exceptions\CollectionIconException: [ERROR] Collection icon "test" does not exist.'."\n");

        try {
            $this->fa->collection('test');            
        } catch(CollectionIconException $e) {
            echo $e;
        }
    }

    public function testIncompleteStackExceptionOutput()
    {
        $this->expectOutputString('Khill\Fontawesome\Exceptions\IncompleteStackException: [ERROR] Stacks must be started with the stack() method.'."\n");

        try {
            $this->fa->on('test');
        } catch(IncompleteStackException $e) {
            echo $e;
        }
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
