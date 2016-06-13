<?php

namespace Khill\FontAwesome;

use InvalidArgumentException;
use Khill\FontAwesome\FontAwesomeList;
use Khill\FontAwesome\FontAwesomeStack;
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
    const VERSION = '1.1.0';

    /**
     * FontAwesome Icon version
     */
    const FA_VERSION = '4.4.0';

    /**
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="fa %s"%s></i>';

    /**
     * Html string template to build the icon stack
     */
    const STACK_HTML = '<span class="%s">%s%s</span>';

    /**
     * Name of the icon
     *
     * @var string
     */
    protected $icon = null;

    /**
     * Store a collection of icons
     *
     * @var array[string]
     */
    private $collection = array();

    /**
     * Stores icon stack
     *
     * @var FontAwesomeStack
     */
    private $stack;

    /**
     * Stores unordered list
     *
     * @var string
     */
    private $list;

    /**
     * HTML link to the FontAwesome CSS file through bootstrapcdn
     *
     * @see http://www.bootstrapcdn.com/
     * @return string HTML link element
     */
    public static function css()
    {
        return '<link href="//netdna.bootstrapcdn.com/font-awesome/' .
        self::FA_VERSION .
        '/css/font-awesome.min.css" rel="stylesheet">';
    }

    /**
     * Assigns the name to the icon
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @throws \InvalidArgumentException
     */
    public function __construct($icon = null)
    {
        if (!$this->usingComposer()) {
            require_once(__DIR__.'/Support/Psr4Autoloader.php');

            $loader = new Psr4Autoloader;
            $loader->register();
            $loader->addNamespace(__NAMESPACE__, __DIR__);
        }

        if ($icon !== null) {
            $this->setIcon($icon);
        }
    }

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @return string HTML string of icon or stack
     */
    public function __toString()
    {
        if ($this->stack instanceof FontAwesomeStack) {
            $output = $this->stack->output();
        } elseif ($this->list instanceof FontAwesomeList) {
            $output = $this->list->output();
        } else {
            $output = $this->output();
        }

        $this->reset();

        return $output;
    }

    /**
     * Sets icon label
     *
     * @access private
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws \InvalidArgumentException
     */
    private function setIcon($icon)
    {
        if (is_string($icon) === false) {
            throw new \InvalidArgumentException(
                'The icon label must be a string.'
            );
        }

        $this->icon = $icon;

        return $this;
    }

    /**
     * Builds the icon from the template
     *
     * @access private
     * @return string
     */
    private function output()
    {
        $attrs   = '';
        $classes = 'fa-' . $this->icon;

        if (count($this->classes) > 0) {
            $classes .= ' ' . implode(' ', $this->classes);
        }

        if (count($this->attributes) > 0) {
            foreach ($this->attributes as $attr => $val) {
                $attrs .= ' ' . $attr . '="' . $val . '"';
            }
        }

        return sprintf(self::ICON_HTML, $classes, $attrs);
    }

    /**
     * Resets the FontAwesome class
     *
     * @access private
     * @return void
     */
    private function reset()
    {
        $this->icon       = null;
        $this->list       = null;
        $this->stack      = null;
        $this->classes    = array();
        $this->attributes = array();
    }

    /**
     * Checks if running in composer environment
     *
     * This will true if the folder 'composer' is within the path to FontAwesomePHP.
     *
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

    /**
     * Sets which icon to use
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws \InvalidArgumentException If $icon is not a string
     */
    public function icon($icon)
    {
        return $this->setIcon($icon);
    }

    /**
     * Builds unordered list with icons
     *
     * @param  string $icon Default icon used in list (optional)
     * @return \Khill\FontAwesome\FontAwesomeList
     * @throws \Khill\FontAwesome\Exceptions\IncompleteListException
     */
    public function ul($icon = null)
    {
        $this->list = new FontAwesomeList();

        if (is_string($icon) === false && is_array($icon) === false) {
            throw new IncompleteListException(
               'List must have a default icon or associative array with icons as keys.'
            );
        }

        if (is_string($icon)) {
            $this->list->setDefaultIcon($icon);
        }

        if (is_array($icon)) {
            $this->list->setListItems($icon);
        }

        return $this->list;
    }

    /**
     * Sets the top icon to be used in a stack
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return FontAwesomeStack
     * @throws \InvalidArgumentException If $icon is not a non empty string
     */
    public function stack($icon, array $classes = array())
    {
        if (is_string($icon) === false) {
            throw new \InvalidArgumentException(
                'Icon label must be a string.'
            );
        }

        $this->stacking = true;
        $this->stack = new FontAwesomeStack($icon, $classes);

        return $this->stack;
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
        $this->reset();

        return $this;
    }

    /**
     * Alias method for store()
     *
     * @codeCoverageIgnore
     * @see FontAwesome::store()
     */
    public function save($label)
    {
        return $this->store($label);
    }

    /**
     * Alias method for store()
     *
     * @codeCoverageIgnore
     * @see FontAwesome::store()
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
     * @throws InvalidArgumentException If $label anything but a non-empty \string
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
     * @codeCoverageIgnore
     * @see FontAwesome::collection()
     */
    public function fetch($label)
    {
        return $this->collection($label);
    }

    /**
     * Alias method for collection()
     *
     * @codeCoverageIgnore
     * @see FontAwesome::collection()
     */
    public function get($label)
    {
        return $this->collection($label);
    }
}
