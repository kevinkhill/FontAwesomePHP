<?php namespace Khill\FontAwesome;

class TestCase extends \PHPUnit_Framework_TestCase {

	protected $FA;

	public function setUp()
	{
		$this->FA = new FontAwesome;
	}

	public function testCdnLink()
	{
		$this->expectOutputString('<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css" rel="stylesheet">');

		echo $this->FA->cdnLink();
	}

}
