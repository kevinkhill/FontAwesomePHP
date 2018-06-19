<?php

namespace Khill\FontAwesome;

require __DIR__.'/FontAwesomeHtmlEntity.php';

use InvalidArgumentException;
use Khill\FontAwesome\FontAwesomeList;
use Khill\FontAwesome\FontAwesomeText;
use Khill\FontAwesome\FontAwesomeStack;
use Khill\FontAwesome\FontAwesomeLayers;
use Khill\FontAwesome\FontAwesomeHtmlEntity;
use Khill\FontAwesome\Support\Psr4Autoloader;
use Khill\FontAwesome\Exceptions\BadLabelException;
use Khill\FontAwesome\Exceptions\CollectionIconException;
use Khill\FontAwesome\Exceptions\IncompleteListException;

/**
 * FontAwesomePHP is a library that wraps the FontAwesome icon set in easy to use php methods
 *
 * @package   Khill\FontAwesome
 * @version   1.1.0
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesome extends FontAwesomeHtmlEntity
{
    /**
     * FontAwesomePHP version
     */
    const VERSION = '2.0.0';

    /**
     * FontAwesome Icon version
     */
    const FA_VERSION = '5.0.13';

    /**
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="%s"%s%s%s></i>';

    /**
     * Html string template to build the icon stack
     */
    const STACK_HTML = '<span class="%s">%s%s</span>';

    /**
     * Store a collection of icons
     *
     * @var array[string]
     */
    private $collection = array();


    /**
     * HTML link to the FontAwesome CSS file through the FontAwesome CDN
     *
     * @see https://fontawesome.com/get-started/web-fonts-with-css
     * @return string HTML link element
     */
    public static function css($pro = false)
    {
        if($pro)
        {
            $url = 'pro.fontawesome.com';
            $integrity = 'sha384-oi8o31xSQq8S0RpBcb4FaLB8LJi9AT8oIdmS1QldR8Ui7KUQjNAnDlJjp55Ba8FG';
        }
        else
        {
            $url = 'use.fontawesome.com';
            $integrity = 'sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp';
        }

        return '<link rel="stylesheet" href="https://' . $url . '/releases/v' .
        self::FA_VERSION . '/css/all.css" integrity="' . $integrity . '" crossorigin="anonymous">';
    }

    /**
     * HTML link to the FontAwesome JS file through the FontAwesome CDN
     *
     * @see https://fontawesome.com/get-started/svg-with-js
     * @return string HTML script tag
     */
    public static function js($pro = false)
    {
        if($pro)
        {
            $url = 'pro.fontawesome.com';
            $integrity = 'sha384-d84LGg2pm9KhR4mCAs3N29GQ4OYNy+K+FBHX8WhimHpPm86c839++MDABegrZ3gn';
        }
        else
        {
            $url = 'use.fontawesome.com';
            $integrity = 'sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe';
        }

        return '<script defer src="https://' . $url . '/releases/v' .
        self::FA_VERSION . '/js/all.js" integrity="' . $integrity . '" crossorigin="anonymous"></script>';
    }

    /**
     * Assigns the name to the icon
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @throws \InvalidArgumentException
     */
    public function __construct($icon = null, $style = 'fas')
    {
        if (!$this->usingComposer()) {
            require_once(__DIR__.'/Support/Psr4Autoloader.php');

            $loader = new Psr4Autoloader;
            $loader->register();
            $loader->addNamespace('Khill\FontAwesome', __DIR__);
        }

        if ($icon !== null) {
            $this->setIcon($icon);
        }

        if ($style !== null) {
            $this->setStyle($style);
        }

        return $this;
    }

    /**
     * Builds the icon from the template
     *
     * @access protected
     * @return string
     */
    protected function output()
    {
        $attrs   = '';
        $classes = $this->style . ' fa-' . $this->icon;
        $transforms = '';
        $mask = '';

        if (!empty($this->classes) && count($this->classes) > 0) {
            $classes .= ' ' . implode(' ', $this->classes);
        }

        if (!empty($this->attributes) && count($this->attributes) > 0) {
            foreach ($this->attributes as $attr => $val) {
                $attrs .= ' ' . $attr . '="' . $val . '"';
            }
        }

        if (!empty($this->transforms) && count($this->transforms) > 0) {
            $transformList = array();
            foreach ($this->transforms as $transform) {
                $transformList[] = implode('-', $transform);
            }
            $transforms = ' data-fa-transform="' . implode(' ', $transformList) . '"';
        }

        if($this->mask) {
            $mask = ' data-fa-mask="' . $this->mask . '"';
        }

        $htmlOutput = sprintf(self::ICON_HTML, $classes, $attrs, $transforms, $mask);

        return $this->resetAndOutput($htmlOutput);
    }

    /**
     * Sets which style to use
     *
     * @param  string $style Icon style (fas, far, fal, fab)
     * @return \Khill\FontAwesome\FontAwesomeHtmlEntity
     * @throws \InvalidArgumentException If $style is not a string
     */
    public function style($style)
    {
        return $this->setStyle($style);
    }

    /**
     * Sets which icon to use
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return \Khill\FontAwesome\FontAwesomeHtmlEntity
     * @throws \InvalidArgumentException If $icon is not a string
     */
    public function icon($icon)
    {
        return $this->setIcon($icon);
    }

    /**
     * Sets which mask to use (only available with the JS SDK)
     *
     * @param  string $mask Mask label, omitting the "fa-" prefix
     * @return \Khill\FontAwesome\FontAwesomeHtmlEntity
     * @throws \InvalidArgumentException If $mask is not a string
     */
    public function mask($mask, $style = 'fas')
    {
        return $this->setMask($mask, $style);
    }

    /**
     * Begins building an unordered list with icons
     *
     * When given a single, string input, the list is started with that parameter
     * as the default icon for all items in the list. New items can be added with
     * the li() method or as an array in the second parameter.
     *
     * If passed an array for the first parameter, then the list is created with
     * the list items automatically applied. If the array has numeric, or was not
     * explicitly defined an icon, then the default will be used. The default can
     * be overriden by passing an icon name as the key to the value.
     *
     * @param  $iconsOrItems string|array[string] Default icon to use if list has non defined
     * @param  $listItems    array[string]        Array of list items
     * @return \Khill\FontAwesome\FontAwesomeList
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function ul($iconsOrItems, $listItems = array())
    {
        $has_string_keys = function (array $array) {
            return count(array_filter(array_keys($array), 'is_string')) > 0;
        };

        if (is_string($iconsOrItems) === false && is_array($iconsOrItems) === false) {
            throw new IncompleteListException(
                'The list must be started with a default icon or an array with explicitly defined icons.'
            );
        }

        if (is_array($iconsOrItems) && $has_string_keys($iconsOrItems) === false) {
            throw new IncompleteListException(
                'The list array must have with explicitly defined icons since no default was given.'
            );
        }

        if (is_string($iconsOrItems)) {
            return new FontAwesomeList($iconsOrItems, $listItems);
        } else {
            return new FontAwesomeList('', $iconsOrItems);
        }
    }

    /**
     * Sets the top icon to be used in a stack
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @param  array  $classes
     * @return \Khill\FontAwesome\FontAwesomeStack
     */
    public function stack($icon, array $classes = array())
    {
        if (is_string($icon) === false) {
            throw new \InvalidArgumentException(
                'Icon label must be a string.'
            );
        }

        return new FontAwesomeStack($icon, $classes);
    }

    /**
     * Sets of icons to be layered together (only available with the JS SDK)
     *
     * @param  array  $classes list of classes to apply to the whole layered set
     * @return \Khill\FontAwesome\FontAwesomeLayers
     */
    public function layers(array $classes = array())
    {
        return new FontAwesomeLayers($classes);
    }

    /**
     * Stores icon to be rendered later and resets
     *
     * @param  string $label Label of icon to save in collection
     * @return self
     * @throws \InvalidArgumentException If $label anything but a non-empty \string
     * @throws \Khill\FontAwesome\Exceptions\CollectionIconException If store() method called without defining an icon
     */
    public function store($label)
    {
        if ($this->icon === null) {
            throw new CollectionIconException(
                'There was no icon defined to store.'
            );
        }

        if (is_string($label) === false || empty($label) === true) {
            throw new \InvalidArgumentException(
                'Collection icon label must be a non-empty string.'
            );
        }

        $this->collection[$label] = $this->output();

        return $this;
    }

    /**
     * Alias method for store()
     *
     * @see FontAwesome::store()
     * @param string $label
     * @return \Khill\FontAwesome\FontAwesome
     */
    public function save($label)
    {
        return $this->store($label);
    }

    /**
     * Alias method for store()
     *
     * @see FontAwesome::store()
     * @param string $label
     * @return \Khill\FontAwesome\FontAwesome
     */
    public function set($label)
    {
        return $this->store($label);
    }

    /**
     * Retrieve icon from collection
     *
     * @param  string $label Icon label used in store method
     * @return string HTML icon string
     * @throws \InvalidArgumentException If $label anything but a non-empty \string
     * @throws CollectionIconException  If icon $label is not set
     */
    public function collection($label)
    {
        if (is_string($label) === false) {
            throw new \InvalidArgumentException(
                'Collection icon label must be a string.'
            );
        }

        if (isset($this->collection[$label]) === false) {
            throw new CollectionIconException(
                'Collection icon "' . $label . '" does not exist.'
            );
        }

        return $this->collection[$label];
    }

    /**
     * Alias method for collection()
     *
     * @see FontAwesome::collection()
     * @param string $label
     * @return string
     */
    public function fetch($label)
    {
        return $this->collection($label);
    }

    /**
     * Alias method for collection()
     *
     * @see FontAwesome::collection()
     * @param string $label
     * @return string
     */
    public function get($label)
    {
        return $this->collection($label);
    }

    /**
     * Outputs the current contents to the page.
     *
     * @param string $htmlOutput
     * @return string
     */
    private function resetAndOutput($htmlOutput)
    {
        $this->icon       = null;
        $this->classes    = null;
        $this->attributes = null;
        $this->mask       = null;
        $this->style       = null;

        return (string) $htmlOutput;
    }

    /**
     * Checks if running in composer environment
     *
     * This will true if the folder 'composer' is within the path to FontAwesomePHP.
     *
     * @codeCoverageIgnore
     * @access private
     * @since 1.1.0
     * @return boolean
     */
    private function usingComposer()
    {
        if (strpos(realpath(__FILE__), 'composer') !== false) {
            return true;
        } else {
            return false;
        }
    }
}
