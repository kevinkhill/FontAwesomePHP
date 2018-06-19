<?php

namespace Khill\FontAwesome\Tests;

use Khill\FontAwesome\FontAwesome;

class FontAwesomeTest extends FontAwesomeTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBadInputForIconOutputThroughConstructor()
    {
        echo new FontAwesome(12);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIconWithInvalidCustomAttribute()
    {
        echo $this->fa->fixedWidth('star')->addAttr(9.81, 'Tooltips!');
        echo $this->fa->fixedWidth('star')->addAttr('id', 9.81);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddingInvalidClass()
    {
        echo $this->fa->fixedWidth('star')->addClass(3.14);
    }

    /**
     * @expectedException \Khill\FontAwesome\Exceptions\InvalidTransformationClass
     */
    public function testApplyingTransformationClassThatDoesntExistAsModifier()
    {
        echo $this->fa->upsideDown('twitter');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingInvalidStyleThroughStyleMethod()
    {
        echo $this->fa->icon('star')->style(5);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingUnknownStyleThroughStyleMethod()
    {
        echo $this->fa->icon('star')->style('fat');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingInvalidStyleThroughConstructor()
    {
        echo new FontAwesome('star', 'fat');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingInvalidTransform()
    {
        echo $this->fa->icon('magic')->transform(25, 26);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingUnknownTransform()
    {
        echo $this->fa->icon('magic')->transform("embiggen", 100);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingInvalidNumericTransform()
    {
        echo $this->fa->icon('magic')->transform("grow","bigger");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingInvalidStringTransform()
    {
        echo $this->fa->icon('magic')->transform("flip","y");
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingInvalidMaskIcon()
    {
        echo $this->fa->icon('pencil')->mask(12);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingInvalidMaskStyle()
    {
        echo $this->fa->icon('pencil')->mask("circle", 7);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSettingUnknownMaskStyle()
    {
        echo $this->fa->icon('pencil')->mask("circle", "fat");
    }

    public function testCdnLinkOutput()
    {
        $this->expectOutputString(
            '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">'
        );

        echo FontAwesome::css();
    }

    public function testJsLinkOutput()
    {
        $this->expectOutputString(
            '<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>'
        );

        echo FontAwesome::js();
    }

    public function testCdnLinkProOutput()
    {
        $this->expectOutputString(
            '<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-oi8o31xSQq8S0RpBcb4FaLB8LJi9AT8oIdmS1QldR8Ui7KUQjNAnDlJjp55Ba8FG" crossorigin="anonymous">'
        );

        echo FontAwesome::css(true);
    }

    public function testJsLinkProOutput()
    {
        $this->expectOutputString(
            '<script defer src="https://pro.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-d84LGg2pm9KhR4mCAs3N29GQ4OYNy+K+FBHX8WhimHpPm86c839++MDABegrZ3gn" crossorigin="anonymous"></script>'
        );

        echo FontAwesome::js(true);
    }

    public function testStandardIconOutputThroughConstructor()
    {
        $this->expectOutputString('<i class="fas fa-star"></i>');

        echo new FontAwesome('star');
    }

    public function testStandardIconOutputThroughIconMethod()
    {
        $this->expectOutputString('<i class="fas fa-star"></i>');

        echo $this->fa->icon('star');
    }

    public function testSettingStyleThroughConstructor()
    {
        $this->expectOutputString('<i class="far fa-star"></i>');

        echo new FontAwesome('star', 'far');
    }

    public function testSettingStyleThroughStyleMethod()
    {
        $this->expectOutputString('<i class="far fa-star"></i>');

        echo $this->fa->icon('star')->style('far');
    }

    public function testStandardIconWithAdditionalClassOutputThroughIconMethod()
    {
        $this->expectOutputString('<i class="fas fa-star frameworkIcon"></i>');

        echo $this->fa->icon('star')->addClass('frameworkIcon');
    }

    public function testIconWithCustomAttributeOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-fw" title="Tooltips!"></i>');

        echo $this->fa->fixedWidth('star')->addAttr('title', 'Tooltips!');
    }

    public function testIconWithCustomAttributesOutput()
    {
        $this->expectOutputString('<i class="fas fa-rocket fa-fw" title="Tooltips!" id="my-icon"></i>');

        echo $this->fa->fixedWidth('rocket')->addAttrs(array(
            'title' => 'Tooltips!',
            'id' => 'my-icon'
        ));
    }

    public function testFixedWidthIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-fw"></i>');

        echo $this->fa->fixedWidth('star');
    }

    public function testFixedWidthIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-fw"></i>');

        echo $this->fa->icon('star')->fixedWidth();
    }

    public function testLargeIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-lg"></i>');

        echo $this->fa->lg('star');
    }

    public function testLargeIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-lg"></i>');

        echo $this->fa->icon('star')->lg();
    }

    public function test2xIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-2x"></i>');

        echo $this->fa->x2('star');
    }

    public function test2xIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-2x"></i>');

        echo $this->fa->icon('star')->x2();
    }

    public function test3xIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-3x"></i>');

        echo $this->fa->x3('star');
    }

    public function test3xIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-3x"></i>');

        echo $this->fa->icon('star')->x3();
    }

    public function test4xIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-4x"></i>');

        echo $this->fa->x4('star');
    }

    public function test4xIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-4x"></i>');

        echo $this->fa->icon('star')->x4();
    }

    public function test5xIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-5x"></i>');

        echo $this->fa->x5('star');
    }

    public function test5xIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-5x"></i>');

        echo $this->fa->icon('star')->x5();
    }

    public function testPulledLeftIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star pull-left"></i>');

        echo $this->fa->left('star');
    }

    public function testPulledLeftIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star pull-left"></i>');

        echo $this->fa->icon('star')->left();
    }

    public function testPulledRightIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star pull-right"></i>');

        echo $this->fa->right('star');
    }

    public function testPulledRightIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star pull-right"></i>');

        echo $this->fa->icon('star')->right();
    }

    public function testInverseIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-inverse"></i>');

        echo $this->fa->inverse('star');
    }

    public function testInverseIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-inverse"></i>');

        echo $this->fa->icon('star')->inverse();
    }

    public function testRotate90IconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-rotate-90"></i>');

        echo $this->fa->rotate90('star');
    }

    public function testRotate90IconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-rotate-90"></i>');

        echo $this->fa->icon('star')->rotate90();
    }

    public function testRotate180IconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-rotate-180"></i>');

        echo $this->fa->rotate180('star');
    }

    public function testRotate180IconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-rotate-180"></i>');

        echo $this->fa->icon('star')->rotate180();
    }

    public function testRotate270IconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-rotate-270"></i>');

        echo $this->fa->rotate270('star');
    }

    public function testRotate270IconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-rotate-270"></i>');

        echo $this->fa->icon('star')->rotate270();
    }

    public function testFlipHorizontalIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-flip-horizontal"></i>');

        echo $this->fa->flipHorizontal('star');
    }

    public function testFlipHorizontalIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-flip-horizontal"></i>');

        echo $this->fa->icon('star')->flipHorizontal();
    }

    public function testFlipVerticalIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-star fa-flip-vertical"></i>');

        echo $this->fa->flipVertical('star');
    }

    public function testFlipVerticalIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-star fa-flip-vertical"></i>');

        echo $this->fa->icon('star')->flipVertical();
    }

    public function testSpinIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-question-circle fa-spin"></i>');

        echo $this->fa->spin('question-circle');
    }

    public function testSpinIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-question-circle fa-spin"></i>');

        echo $this->fa->icon('question-circle')->spin();
    }

    public function testBorderIconOutput()
    {
        $this->expectOutputString('<i class="fas fa-trash fa-border"></i>');

        echo $this->fa->border('trash');
    }

    public function testBorderIconOutputThroughInstanceChain()
    {
        $this->expectOutputString('<i class="fas fa-trash fa-border"></i>');

        echo $this->fa->icon('trash')->border();
    }

    public function testTransformShrinkOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="shrink-8"></i>');

        echo $this->fa->icon('magic')->transform("shrink",8);
    }

    public function testTransformGrowOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="grow-2.5"></i>');

        echo $this->fa->icon('magic')->transform("grow",2.5);
    }

    public function testTransformRotateOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="rotate-90"></i>');

        echo $this->fa->icon('magic')->transform("rotate",90);
    }

    public function testTransformNegativeRotateOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="rotate--90"></i>');

        echo $this->fa->icon('magic')->transform("rotate",-90);
    }

    public function testTransformUpOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="up-2"></i>');

        echo $this->fa->icon('magic')->transform("up",2);
    }

    public function testTransformDownOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="down-1.5"></i>');

        echo $this->fa->icon('magic')->transform("down",1.5);
    }

    public function testTransformFlipVerticalOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="flip-v"></i>');

        echo $this->fa->icon('magic')->transform("flip","v");
    }

    public function testTransformFlipHorizontalOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="flip-h"></i>');

        echo $this->fa->icon('magic')->transform("flip","h");
    }

    public function testTransformFlipBothOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="flip-v flip-h"></i>');

        echo $this->fa->icon('magic')->transform("flip","v")->transform("flip","h");
    }

    public function testMultipleTransformsOutput()
    {
        $this->expectOutputString('<i class="fas fa-magic" data-fa-transform="grow-5 rotate-270"></i>');

        echo $this->fa->icon('magic')->addTransforms(array("grow" => 5, "rotate" => 270));
    }

    public function testSimpleMaskOutput()
    {
        $this->expectOutputString('<i class="fas fa-pencil" data-fa-mask="fas fa-circle"></i>');

        echo $this->fa->icon('pencil')->mask("circle");
    }

    public function testMaskWithTransformOutput()
    {
        $this->expectOutputString('<i class="fas fa-pencil" data-fa-transform="shrink-10 up-0.5" data-fa-mask="fas fa-circle"></i>');

        echo $this->fa->icon('pencil')->transform("shrink", 10)->transform("up", 0.5)->mask("circle");
    }

    public function testMaskWithTransformAndStyleOutput()
    {
        $this->expectOutputString('<i class="fab fa-facebook-f" data-fa-transform="shrink-3.5 down-1.6 right-1.25" data-fa-mask="fas fa-square"></i>');

        echo $this->fa->icon('facebook-f')->style("fab")->transform("shrink", 3.5)->transform("down", 1.6)->transform("right", 1.25)->mask("square");
    }
}
