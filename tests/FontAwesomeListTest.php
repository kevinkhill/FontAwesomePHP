<?php

namespace Khill\FontAwesome\Tests;

class FontAwesomeListTest extends FontAwesomeTestCase
{
    public function testChainedSingleIconListIconOutput()
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

    public function testArrayItemsSingleIconListIconOutput()
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

    public function testMultipleIconArrayItemsListOutput()
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
