<?php

namespace Khill\FontAwesome\Tests;

use Khill\FontAwesome\FontAwesome;
use Khill\FontAwesome\FontAwesomeText;

class FontAwesomeLayersTest extends FontAwesomeTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidIconInLayer()
    {
        echo $this->fa->layers()->icon("circle")->icon(new FontAwesome("times"));
    }

    public function testBasicLayersOutput()
    {
        $this->expectOutputString('<span class="fa-layers fa-fw"><i class="fas fa-circle"></i><i class="fas fa-times"></i></span>');

        echo $this->fa->layers()->icon(new FontAwesome("circle"))->icon(new FontAwesome("times"));
    }

    public function testBasicLayersWithClassOutput()
    {
        $this->expectOutputString('<span class="fa-layers fa-fw my-cool-layer"><i class="fas fa-circle"></i><i class="fas fa-times"></i></span>');
        $classes = array("my-cool-layer");
        echo $this->fa->layers($classes)->icon(new FontAwesome("circle"))->icon(new FontAwesome("times"));
    }

    public function testMultipleLayersWithTransformsOutput()
    {
        $this->expectOutputString('<span class="fa-layers fa-fw"><i class="fas fa-play" data-fa-transform="rotate--90 grow-2"></i><i class="fas fa-sun fa-inverse" data-fa-transform="shrink-10 up-2"></i><i class="fas fa-moon fa-inverse" data-fa-transform="shrink-11 down-4.2 left-4"></i><i class="fas fa-star fa-inverse" data-fa-transform="shrink-11 down-4.2 right-4"></i></span>');

        $triangle = new FontAwesome("play");
        $sun = new FontAwesome("sun");
        $moon = new FontAwesome("moon");
        $star = new FontAwesome("star");

        echo $this->fa->layers()
            ->icon($triangle->transform("rotate", -90)->transform("grow", 2))
            ->icon($sun->inverse()->transform("shrink", 10)->transform("up", 2))
            ->icon($moon->inverse()->transform("shrink", 11)->transform("down", 4.2)->transform("left", 4))
            ->icon($star->inverse()->transform("shrink", 11)->transform("down", 4.2)->transform("right", 4));
    }

    public function testLayersWithCounterOutput()
    {
        $this->expectOutputString('<span class="fa-layers fa-fw"><i class="fas fa-envelope"></i><span class="fa-layers-counter">1,419</span></span>');

        echo $this->fa->layers()->icon(new FontAwesome("envelope"))->counter("1,419");
    }

    public function testLayersWithCounterAndClassesOutput()
    {
        $this->expectOutputString('<span class="fa-layers fa-fw"><i class="fas fa-envelope"></i><span class="fa-layers-counter my-cool-counter">1,419</span></span>');

        echo $this->fa->layers()->icon(new FontAwesome("envelope"))->counter("1,419", array("my-cool-counter"));
    }

    public function testLayersWithTextOutput()
    {
        $this->expectOutputString('<span class="fa-layers fa-fw"><i class="fas fa-certificate"></i><span class="fa-layers-text fa-inverse" data-fa-transform="shrink-11.5 rotate--30">NEW</span></span>');

        $text = new FontAwesomeText("NEW");

        echo $this->fa->layers()->icon(new FontAwesome("certificate"))->text($text->inverse()->transform("shrink", 11.5)->transform("rotate", -30));
    }

}
