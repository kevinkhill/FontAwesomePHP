<?php

namespace Khill\FontAwesome;

use Khill\FontAwesome\Exceptions\IncompleteListException;

/**
 * FontAwesomeList adds the ability to create unordered lists with icons
 *
 * @package   Khill\FontAwesome
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
     * Assigns the name to the icon
     *
     * @param string $icon Icon label
     * @param array  $listItems
     */
    public function __construct($icon, array $listItems)
    {
        $this->setIcon($icon);

        if (count($listItems) > 0) {
            $this->addItems($listItems);
        }
    }

    /**
     * Adds items to unordered list
     *
     * If the first parameter is a string, and the second parameter is ommited,
     * then a single item is added to the list, using the default icon.
     *
     * If the first parameter is a string, and the second is also a string, then
     * the first is the icon for the item, and the second, the value of the item.
     *
     * If the first parameter is an array of strings, with no keys, then they are
     * all added as list items.
     *
     * If the first parameter is an array of strings, with string keys, then they
     * are added to the list with they keys being assigned as the icon. If there
     * are some string keys and some numeric, the numeric items will be assigned
     * the default icon.
     *
     * @param  string|array[string] $iconOrLine
     * @param  string $liVal
     * @return self
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function li($iconOrLine, $liVal = null)
    {
        if (is_string($iconOrLine) === false && is_array($iconOrLine) === false) {
            throw new IncompleteListException(
                'List items must be a string or array of strings.'
            );
        }

        if (is_string($iconOrLine) && is_null($liVal)) {
            return $this->addItem(null, $iconOrLine);
        }

        if (is_string($iconOrLine) && is_string($liVal)) {
            return $this->addItem($iconOrLine, $liVal);
        }

        if (is_array($iconOrLine)) {
            return $this->addItems($iconOrLine);
        }
    }

    /**
     * Outputs the FontAwesomeList object as an HTML string
     *
     * @return string
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    protected function output()
    {
        $listItems = '';

        foreach ($this->lines as $li) {
            $icon = $this->buildIcon($li[0]);

            $listItems .= sprintf(self::LI_HTML, $icon, $li[1]);
        }

        return sprintf(self::UL_HTML, $listItems);
    }

    /**
     * Add an item to the list
     *
     * @param  string $icon  Icon to assign the list item
     * @param  string $liVal Value of the list item
     * @return self
     */
    private function addItem($icon, $liVal)
    {
        if ($icon === null) {
            $this->lines[] = array($this->icon, $liVal);
        } else {
            $this->lines[] = array($icon, $liVal);
        }

        return $this;
    }

    /**
     * Add multiple items to list
     *
     * @param  array $lineArray Array of lines to add to list
     * @return self
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    private function addItems(array $lineArray)
    {
        foreach ($lineArray as $icon => $liVal) {
            $icon = is_string($icon) ? $icon : null;

            $this->addItem($icon, $liVal);
        }

        return $this;
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
        if (count($this->classes) > 0) {
            foreach($this->classes as $class) {
                $classes .= implode(' ', $class);
            }
        }
*/
        return sprintf(self::ICON_HTML, $classes);
    }
}
