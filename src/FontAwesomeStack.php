<?php namespace Khill\Fontawesome;

/**
* FontAwesomeStack builds icon stacks
*
* @package  FontAwesomePHP
* @author   Kevin Hill <kevinkhill@gmail.com>
* @version  1.0b1
* @access   public
* @see      http://kevinkhill.github.io/FontAwesomePHP
*/

use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;
use Khill\Fontawesome\Exceptions\IncompleteStackException;

class FontAwesomeStack {

    /**
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="fa fa-%s %s"></i>';

    /**
     * Html string template to build the icon stack
     */
    const STACK_HTML = '<span class="%s">%s%s</span>';

    /**
     * Classes to be applied to the stack
     *
     * @var array
     */
    private $classes = array();

    /**
     * Stores top icon in a stack
     *
     * @var string
     */
    public $topIcon = '';

    /**
     * Stores bottom icon in a stack
     *
     * @var string
     */
    public $bottomIcon = '';

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @access public
     * @return string HTML string of icon or stack
     */
    public function output()
    {
        $classes = 'fa-stack';

        if(count($this->classes) > 0)
        {
            foreach($this->classes as $class)
            {
                $classes .= ' ' . $class;
            }
        }

        return sprintf(self::STACK_HTML, $classes, $this->topIcon, $this->bottomIcon);
    }
  
    /**
     * Sets the top icon to be used in a stack
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
     */
    public function setTopIcon($icon)
    {
        $this->topIcon = sprintf(self::ICON_HTML, $icon, 'fa-stack-2x');
    }

    /**
     * Sets the bottom icon to be used in a stack
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @throws Khill\Fontawesome\Exceptions\IncompleteStackException If The on() method was called without the stack() method
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
     */
    public function setBottomIcon($icon)
    {
        $this->bottomIcon = sprintf(self::ICON_HTML, $icon, 'fa-stack-1x');
    } 

    /**
     * Add extra classes to the stack
     * 
     * @access public
     * @param string $class CSS class
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $class is not a string
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
     */
    public function addClass($class)
    {
        $this->classes[] = $class;
    }

}
