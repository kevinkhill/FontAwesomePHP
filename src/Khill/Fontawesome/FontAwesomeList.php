<?php namespace Khill\Fontawesome;

/**
* FontAwesomeList adds the ability to create unordered lists with icons
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

class FontAwesomeList {

    /**
     * Html string template to build the list
     */
    const UL_HTML = '<ul class="fa-ul">%s</ul>';

    /**
     * Html string template to build the list items
     */
    const LI_HTML = '<li>%s%s</li>';

    /**
     * Classes to be applied to the list
     *
     * @var array
     */
    private $classes = array();

    /**
     * Name of the icon to apply to entire list
     *
     * @var string
     */
    private $iconLabel = '';

    /**
     * Assigns the name to the icon
     *
     * @param  string $icon Icon label
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function __construct($icon = '')
    {
        $this->_setIcon($icon);
    }

    /**
     * Outputs the FontAwesomeList object as an HTML string
     *
     * @access public
     * @return string HTML string of icon or stack
     */
    public function __toString()
    {
//        if( ! empty($this->stackTop) &&  empty($this->stackBottom))
//        {
            if( ! empty($this->stackTop) &&  empty($this->stackBottom))
            {
                $output = $this->_buildStack();
            } else {
                $output = $this->_buildIcon();
            }
//        } else {
//            throws new IncompleteStackException('Error: The stack is incomplete.');
//        }
        $this->_reset();
        
        return $output;
    }

    /**
     * Sets which icon to use
     * 
     * @access public
     * @param  string $icon Icon label, ommiting fa- prefix
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function icon($icon)
    {
        $this->_setIcon($icon);
        
        return $this;
    }

    /**
     * Adds extra classes to list
     * 
     * @access public
     * @param string $class CSS class
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $class is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function addClass($class)
    {
        if(is_string($class))
        {
            $this->classes[] = $class;
        } else {
            throw new BadLabelException('Additional classes must be a string.');
        }

        return $this;
    }

    public function ul()
    {
        return $this;
    }

    public function li()
    {
        return $this;
    }

    /**
     * Sets the top icon to be used in a stack
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function stack($icon)
    {
        $this->_setIcon($icon);
        $this->stacking = true;

        return $this;
    }

    /**
     * Sets the bottom icon to be used in a stack
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @throws Khill\Fontawesome\Exceptions\IncompleteStackException If The on() method was called without the stack() method
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function on($icon)
    {
        if($this->stacking === true)
        {
            $this->stackTop = $this->_buildIcon();
            $this->_setIcon($icon);
        } else {
            throw new IncompleteStackException('Stacks must be started with the stack() method.');
        }

        return $this;
    }


    /**
     * Sets icon label
     * 
     * @access private
     * @param string $icon Icon label
     * @return void
     */
    private function _setIcon($icon)
    {
        if(is_string($icon))
        {
            if( ! empty($icon))
            {
                $this->iconLabel = $icon;
            }
        } else {
            throw new BadLabelException('Icon label must be a string.');
        }
    }

    /**
     * Builds the icon from the template
     * 
     * @access private
     * @return void
     */
    private function _buildIcon()
    {
        $classes = 'fa-' . $this->iconLabel;

        if( ! empty($this->classes))
        {
            foreach($this->classes as $class)
            {
                $classes .= ' ' . $class;
            }
        }

        return sprintf(self::ICON_HTML, $classes);
    }

    /**
     * Builds the stack from the template
     * 
     * @access private
     * @return void
     */
    private function _buildList()
    {
        $classes = 'fa-stack';

        $this->stackBottom = $this->_buildIcon();
        $this->_setStackPositions();

        if( ! empty($this->stackClasses))
        {
            foreach($this->stackClasses as $class)
            {
                $classes .= ' ' . $class;
            }
        }

        return sprintf(self::STACK_HTML, $classes, $this->stackTop, $this->stackBottom);
    }

    /**
     * Resets the FontAwesomeList class
     * 
     * @access private
     * @return void
     */
    private function _reset()
    {
        $this->iconLabel  = '';
        $this->classes    = array();
    }

}
