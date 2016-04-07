<?php

namespace Khill\Fontawesome\Tests;

class FontAwesomeListTest extends FontAwesomeTestCase
{
    public function testChainedSingleIconListIconOutput()
    {
        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-square"></i>This is my first item</li>';
        $output .= '<li><i class="fa fa-square"></i>This is my second item</li>';
        $output .= '<li><i class="fa fa-square"></i>This is my third item</li>';
        $output .= '<li><i class="fa fa-square"></i>This is my fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul('square')
                      ->li('This is my first item')
                      ->li('This is my second item')
                      ->li('This is my third item')
                      ->li('This is my fourth item');
    }

    public function testArrayItemsSingleIconListIconOutput()
    {
        $listItems = array(
            'This is my first item',
            'This is my second item',
            'This is my third item',
            'This is my fourth item'
        );

        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-square"></i>This is my first item</li>';
        $output .= '<li><i class="fa fa-square"></i>This is my second item</li>';
        $output .= '<li><i class="fa fa-square"></i>This is my third item</li>';
        $output .= '<li><i class="fa fa-square"></i>This is my fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul('square')->li($listItems);
    }

    public function testMultipleIconArrayItemsListOutput()
    {
        $listItems = array(
            'magic' => 'This is my first item',
            'music' => 'This is my second item',
            'road'  => 'This is my third item',
            'phone' => 'This is my fourth item'
        );

        $output  = '<ul class="fa-ul">';
        $output .= '<li><i class="fa fa-magic"></i>This is my first item</li>';
        $output .= '<li><i class="fa fa-music"></i>This is my second item</li>';
        $output .= '<li><i class="fa fa-road"></i>This is my third item</li>';
        $output .= '<li><i class="fa fa-phone"></i>This is my fourth item</li>';
        $output .= '</ul>';

        $this->expectOutputString($output);

        echo $this->fa->ul($listItems);
    }
}
