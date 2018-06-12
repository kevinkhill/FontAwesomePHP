<?php

namespace Khill\FontAwesome\Tests;

class FontAwesomeCollectionTest extends FontAwesomeTestCase
{

/**
 * @expectedException \Khill\FontAwesome\Exceptions\CollectionIconException
 */
    public function testStoringNoIconOutput()
    {
        $this->fa->store('loginIcon');
    }

    public function testRetrievingStoredIconFromCollectionOutput()
    {
        $this->fa->icon('cog')->store('loginIcon');

        $this->expectOutputString('<i class="fas fa-cog"></i>');

        echo $this->fa->collection('loginIcon');
    }

    /**
     * @depends testRetrievingStoredIconFromCollectionOutput
     */
    public function testRetrievingStoredIconFromCollectionWithFetchAliasOutput()
    {
        $this->fa->icon('cog')->store('loginIcon');

        $this->expectOutputString('<i class="fas fa-cog"></i>');

        echo $this->fa->fetch('loginIcon');
    }

    /**
     * @depends testRetrievingStoredIconFromCollectionOutput
     */
    public function testRetrievingStoredIconFromCollectionWithGetAliasOutput()
    {
        $this->fa->icon('cog')->store('loginIcon');

        $this->expectOutputString('<i class="fas fa-cog"></i>');

        echo $this->fa->get('loginIcon');
    }

    /**
     * @depends testRetrievingStoredIconFromCollectionOutput
     */
    public function testRetrievingStoredIconFromCollectionStoredWithSaveAliasOutput()
    {
        $this->fa->icon('cog')->save('loginIcon');

        $this->expectOutputString('<i class="fas fa-cog"></i>');

        echo $this->fa->collection('loginIcon');
    }

    /**
     * @depends testRetrievingStoredIconFromCollectionOutput
     */
    public function testRetrievingStoredIconFromCollectionStoredWithSetAliasOutput()
    {
        $this->fa->icon('cog')->set('loginIcon');

        $this->expectOutputString('<i class="fas fa-cog"></i>');

        echo $this->fa->collection('loginIcon');
    }

    public function testRetrievingCustomizedStoredIconFromCollectionOutput()
    {
        $this->fa->style('far')->x4('cog')->flipVertical()->store('myLabel');

        $this->expectOutputString('<i class="far fa-cog fa-4x fa-flip-vertical"></i>');

        echo $this->fa->collection('myLabel');
    }

    /**
     * @depends testRetrievingStoredIconFromCollectionOutput
     */
    public function testStoringAndFetchingIconWithCustomAttributeOutput()
    {
        $this->fa->icon('rocket')->addAttr('title', 'Tooltips!')->store('mine');

        $this->expectOutputString('<i class="fas fa-rocket" title="Tooltips!"></i>');

        echo $this->fa->collection('mine');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testStoringIconIntoCollectionWithBadLabel()
    {
        $this->fa->icon('cog')->store(4.1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRetrievingIconFromCollectionWithBadLabel()
    {
        $this->fa->icon('cog')->store('loginIcon');

        echo $this->fa->collection(4.1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCollectionWithLabelThatDoesntExist()
    {
        $this->fa->collection('banana');
    }
}
