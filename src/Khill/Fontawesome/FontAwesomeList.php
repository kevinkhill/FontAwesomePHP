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
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="fa %s"></i>';

    /**
     * Classes to be applied to the list
     *
     * @var array
     */
    private $classes = array();

    /**
     * Lines in the list
     *
     * @var array
     */
    private $lines = array();

    /**
     * Name of the icon to apply to entire list
     *
     * @var string
     */
    private $iconLabel = '';

    /**
     * Full list
     *
     * @var array
     */
    private $fullList = array();

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
    public function output()
    {
        $listItems = '';

        foreach($this->lines as $line)
        {
            if(isset($this->defaultIcon))
            {
                $icon = $this->_buildIcon($this->defaultIcon);
            } else {

            }
            
            $listItems .= sprintf(self::LI_HTML, $icon, $line);
        }

        return sprintf(self::UL_HTML, $listItems);
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

    public function addItem($line)
    {
        if(is_string($line))
        {
            $this->lines[] = $line;
        } else {
            throw new BadLabelException('List items must be a string.');
        }

        return $this;
    }


    public function addItems($lineArray)
    {
        if(is_array($lineArray))
        {
            foreach($lineArray as $line)
            {
                $this->addItem($line);
            }
        }

        return $this;
    }

    /**
     * Sets the default icon to be used in the list
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function setDefaultIcon($icon)
    {
        $this->_setIcon($icon);
    }

    public function setListItems($listItems)
    {
        $this->listItems = $listItems;
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
                $this->defaultIcon = $icon;
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
    private function _buildIcon($iconLabel)
    {
        $classes = 'fa-' . $iconLabel;
/*
        if( ! empty($this->classes))
        {
            foreach($this->classes as $class)
            {
                $classes .= ' ' . $class;
            }
        }
*/
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
