<?php namespace Khill\Fontawesome;

class FontAwesomeListTest extends \PHPUnit_Framework_TestCase {

    public $fa;

    public function setUp()
    {
        $this->fa = new FontAwesome();
    }

    public function testBasicListIconOutput()
    {
       $this->expectOutputString('<ul class="fa-ul"><i class="fa fa-"></i><i class="fa fa-"></i></ul>');

        echo $this->fa->ul()
                      ->li('magic', 'This is my first item')
                      ->li('music', 'This is my second item')
                      ->li('road', 'This is my third item')
                      ->li('phone', 'This is my fourth item');
    }

    public function testBasicListWithItemsFromArrayIconOutput()
    {
        $listItems = array(
            'magic' => 'This is my first item',
            'music' => 'This is my second item',
            'road'  => 'This is my third item',
            'phone' => 'This is my fourth item'
        );

        $this->expectOutputString('<ul class="fa-ul"><i class="fa fa-"></i><i class="fa fa-"></i></ul>');

        echo $this->fa->ul($listItems);
    }

}
