<?php

namespace Khill\FontAwesome\Tests;

class FontAwesomeListTest extends FontAwesomeTestCase
{
    /**
     * @expectedException \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function testInvalidValuesForUlMethod()
    {
        $this->fa->ul(3);
        $this->fa->ul('square', 4.5);
    }

    /**
     * @expectedException \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function testStartingListWithAndArrayOfItemsNoDefaultIcon()
    {
        $this->fa->ul(array(
            'item one',
            'item two'
        ));
    }

    public function testDefaultIconWithAddingSingleLinesOutput()
    {
        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-square"></i>first item</li>';
        $output .= '<li><i class="fa fa-square"></i>second item</li>';
        $output .= '<li><i class="fa fa-square"></i>third item</li>';
        $output .= '<li><i class="fa fa-square"></i>fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul('square')
                      ->li('first item')
                      ->li('second item')
                      ->li('third item')
                      ->li('fourth item');
    }

    public function testDefaultIconWithAddingSingleLineWithExplicitIconOutput()
    {
        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-square"></i>first item</li>';
        $output .= '<li><i class="fa fa-rocket"></i>second item</li>';
        $output .= '<li><i class="fa fa-square"></i>third item</li>';
        $output .= '<li><i class="fa fa-circle"></i>fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul('square')
                      ->li('first item')
                      ->li('rocket', 'second item')
                      ->li('third item')
                      ->li('circle', 'fourth item');
    }

    /**
     * @depends testDefaultIconWithAddingSingleLineWithExplicitIconOutput
     * @expectedException \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function testInvalidValuesForLiMethod()
    {
        $this->fa->ul('square')
                 ->li(3);

        $this->fa->ul('square')
                 ->li('circle', 4.5);
    }

    public function testDefaultIconWithAddingArrayOfLinesOutput()
    {
        $listItems = array(
            'first item',
            'second item',
            'third item',
            'fourth item'
        );

        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-square"></i>first item</li>';
        $output .= '<li><i class="fa fa-square"></i>second item</li>';
        $output .= '<li><i class="fa fa-square"></i>third item</li>';
        $output .= '<li><i class="fa fa-square"></i>fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul('square')->li($listItems);
    }

    public function testCreatingCompleteListFromArrayWithDefaultIconOutput()
    {
        $listItems = array(
            'first item',
            'second item',
            'third item',
            'fourth item'
        );

        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-rocket"></i>first item</li>';
        $output .= '<li><i class="fa fa-rocket"></i>second item</li>';
        $output .= '<li><i class="fa fa-rocket"></i>third item</li>';
        $output .= '<li><i class="fa fa-rocket"></i>fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul('rocket', $listItems);
    }

    public function testCreatingCompleteListFromArrayWithSomeExplicitIconsOutput()
    {
        $listItems = array(
            'magic' => 'first item',
            'second item',
            'road'  => 'third item',
            'fourth item'
        );

        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-magic"></i>first item</li>';
        $output .= '<li><i class="fa fa-wrench"></i>second item</li>';
        $output .= '<li><i class="fa fa-road"></i>third item</li>';
        $output .= '<li><i class="fa fa-wrench"></i>fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul('wrench', $listItems);
    }

    public function testCreatingCompleteListFromArrayWithIconsOutput()
    {
        $listItems = array(
            'magic' => 'first item',
            'music' => 'second item',
            'road'  => 'third item',
            'phone' => 'fourth item'
        );

        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-magic"></i>first item</li>';
        $output .= '<li><i class="fa fa-music"></i>second item</li>';
        $output .= '<li><i class="fa fa-road"></i>third item</li>';
        $output .= '<li><i class="fa fa-phone"></i>fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul($listItems);
    }
}
