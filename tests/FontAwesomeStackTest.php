<?php

namespace Khill\Fontawesome\Tests;

class FontAwesomeStackTest extends FontAwesomeTestCase
{
    public function testBasicStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic');
    }

    public function testLargeStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-lg"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->lg();
    }

    public function test2xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-2x"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x2();
    }

    public function test3xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-3x"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x3();
    }

    public function test4xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-4x"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x4();
    }

    public function test5xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-5x"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x5();
    }

    public function testMultipleStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span><span class="fa-stack"><i class="fa fa-twitter fa-stack-2x"></i><i class="fa fa-circle-o fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic');
        echo $this->fa->stack('twitter')->on('circle-o');
    }

    public function testExtraClassStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fancyClass"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->addClass('fancyClass');
    }

    public function testExtraClassesFromArrayStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fancyClass1 fancyClass2"><i class="fa fa-ban fa-stack-2x"></i><i class="fa fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->addClass(array('fancyClass1', 'fancyClass2'));
    }
}
