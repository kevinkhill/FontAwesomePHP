<?php

namespace Khill\FontAwesome;

/**
 * FontAwesomeList adds the ability to create unordered lists with icons
 *
 * @package   Khill\FontAwesome
 * @version   1.1.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesomeList extends FontAwesomeHtmlEntity
{
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
     * Lines in the list
     *
     * @var array[string]
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
     */
    public function __construct($icon = '')
    {
        $this->setIcon($icon);
    }

    /**
     * Adds items to unordered list with icons
     *
     * @param  string|array[string] $icon Adds a line or lines to the unordered list
     * @return self
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function li($icon = null)
    {
        if (is_string($icon) === false && is_array($icon) === false) {
            throw new IncompleteListException(
                'List items must be a string or array of strings.'
            );
        }

        if (is_string($icon)) {
            $this->addItem($icon);
        }

        if (is_array($icon)) {
            $this->addItems($icon);
        }

        return $this;
    }

    /**
     * Outputs the FontAwesomeList object as an HTML string
     *
     * @return string
     * @throws \Khill\FontAwesome\IncompleteListException
     */
    public function output()
    {
        $listItems = '';

        if (is_array($this->fullList) && count($this->fullList) > 0) {
            foreach ($this->fullList as $icon => $line) {
                $lineIcon = $this->buildIcon($icon);
                $listItems .= sprintf(self::LI_HTML, $lineIcon, $line);
            }
        } else {
            foreach ($this->lines as $line) {
                if (isset($this->defaultIcon)) {
                    $icon = $this->buildIcon($this->defaultIcon);
                } else {
                    throw new IncompleteListException('No default icon was defined.');
                }

                $listItems .= sprintf(self::LI_HTML, $icon, $line);
            }
        }

        return sprintf(self::UL_HTML, $listItems);
    }

    /**
     * Add an item to the list
     *
     * @param  string $line Line to add to the list
     * @return self
     * @throws \Khill\FontAwesome\IncompleteListException If $line is not a string
     */
    public function addItem($line)
    {
        if (is_string($line) === false) {
            throw new IncompleteListException('List item must be a non empty string.');
        }

        $this->lines[] = $line;

        return $this;
    }

    /**
     * Add multiple items to list
     *
     * @param  array $lineArray Array of lines to add to list
     * @return self
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException If $lineArray is not an array
     */
    public function addItems(array $lineArray)
    {
        foreach ($lineArray as $line) {
            $this->addItem($line);
        }

        return $this;
    }

    /**
     * Sets the default icon to be used in the list
     *
     * @param  string $icon Icon label
     * @throws \Khill\FontAwesome\Exceptions\BadLabelException If $icon is not a string
     * @return void
     */
    public function setDefaultIcon($icon)
    {
        $this->setIcon($icon);
    }

    /**
     * Sets the entire list with multiple icons
     *
     * @param  array $listItems Array of icons and list items
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function setListItems($listItems)
    {
        if (is_array($listItems) && $this->testAssocArray($listItems)) {
            $this->fullList = $listItems;
        } else {
            throw new IncompleteListException(
                'Must pass array with keys as icon names and values as lines for list.'
            );
        }

    }


    /**
     * Sets icon label
     *
     * @access private
     * @param  string $icon Icon label
     * @return void
     */
    private function setIcon($icon)
    {
        if (is_string($icon)) {
            if (! empty($icon)) {
                $this->defaultIcon = $icon;
            }
        } else {
            throw new \InvalidArgumentException('Icon label must be a string.');
        }
    }

    /**
     * Builds the icon from the template
     *
     * @access private
     * @return void
     */
    private function buildIcon($iconLabel)
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

        $this->stackBottom = $this->buildIcon();
        $this->_setStackPositions();

        if (! empty($this->stackClasses)) {
            foreach ($this->stackClasses as $class) {
                $classes .= ' ' . $class;
            }
        }

        return sprintf(self::STACK_HTML, $classes, $this->stackTop, $this->stackBottom);
    }

    /**
     * Tests if array keys are strings
     *
     * @param  array Array to test
     * @return boolean True if keys are strings, false if not
     */
    private function testAssocArray($array)
    {
        return (bool) count(array_filter(array_keys($array), 'is_string'));
    }
}
