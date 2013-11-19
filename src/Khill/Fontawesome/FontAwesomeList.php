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
     * @throws Khill\Fontawesome\Exceptions\IncompleteListException If No default icon was setempty string
     * @return string HTML string of list
     */
    public function output()
    {
        $listItems = '';

        if(is_array($this->fullList) && count($this->fullList) > 0)
        {
            foreach($this->fullList as $icon => $line)
            {
                $lineIcon = $this->_buildIcon($icon);
                $listItems .= sprintf(self::LI_HTML, $lineIcon, $line);
            }
        } else {
            foreach($this->lines as $line)
            {
                if(isset($this->defaultIcon))
                {
                    $icon = $this->_buildIcon($this->defaultIcon);
                } else {
                    throw new IncompleteListException('No default icon was defined.');
                }
                
                $listItems .= sprintf(self::LI_HTML, $icon, $line);
            }
        }

        return sprintf(self::UL_HTML, $listItems);
    }

    /**
     * Adds extra classes to list
     * 
     * @access public
     * @param string $class CSS class
     * @throws Khill\Fontawesome\Exceptions\IncompleteListException If $class is not a non empty string
     * @return Khill\Fontawesome\FontAwesomeList FontAwesomeList object
     */
    public function addClass($class)
    {
        if(is_string($class))
        {
            $this->classes[] = $class;
        } else {
            throw new BadLabelException('Additional classes must be a non empty string.');
        }

        return $this;
    }

    /**
     * Add an item to the list
     * 
     * @access public
     * @param  string $line Line to add to the list
     * @throws Khill\Fontawesome\Exceptions\IncompleteListException If $line is not a non empty string
     * @return Khill\Fontawesome\FontAwesomeList FontAwesomeList object
     */
    public function addItem($line)
    {
        if(is_string($line))
        {
            $this->lines[] = $line;
        } else {
            throw new IncompleteListException('List item must be a non empty string.');
        }

        return $this;
    }

    /**
     * Add multiple items to list
     * 
     * @access public
     * @param  string $lineArray Array of lines to add to list
     * @throws Khill\Fontawesome\Exceptions\IncompleteListException If $lineArray is not an array
     * @return Khill\Fontawesome\FontAwesomeList FontAwesomeList object
     */
    public function addItems($lineArray)
    {
        if(is_array($lineArray))
        {
            foreach($lineArray as $line)
            {
                $this->addItem($line);
            }
        } else {
            throw new IncompleteListException('You must pass an array of non empty strings.');
        }

        return $this;
    }

    /**
     * Sets the default icon to be used in the list
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return void
     */
    public function setDefaultIcon($icon)
    {
        $this->_setIcon($icon);
    }

    /**
     * Sets the entire list with multiple icons
     * 
     * @access public
     * @param  array $listItems Array of icons and list items
     * @return void
     */
    public function setListItems($listItems)
    {
        if(is_array($listItems) && $this->_testAssocArray($listItems))
        {
            $this->fullList = $listItems;            
        } else {
            throw new IncompleteListException('Must pass array with keys as icon names and values as lines for list.');
        }

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
     * Tests if array keys are strings
     *
     * @param  array ARray to test
     * @return boolean True if keys are strings, false if not
     */
    private function _testAssocArray($array)
    {
        return (bool) count(array_filter(array_keys($array), 'is_string'));
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
