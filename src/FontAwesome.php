<?php

namespace Khill\Fontawesome;

use InvalidArgumentException;
use Khill\Fontawesome\FontAwesomeList;
use Khill\Fontawesome\FontAwesomeStack;
use Khill\Fontawesome\Support\Psr4Autoloader;
use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;
use Khill\Fontawesome\Exceptions\IncompleteStackException;
use Khill\Fontawesome\Exceptions\IncompleteListException;

/**
 * FontAwesomePHP is a library that wraps the FontAwesome icon set in easy to use php methods
 *
 * @version   1.0.6
 * @package   Khill\Fontawesome
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesome
{
    /**
     * FontAwesomePHP version
     */
    const VERSION = '1.0.6';

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
    private $currentIcon = null;

    /**
     * Classes to be applied to the icon
     *
     * @var Array[string]
     */
    private $classes = array();

    /**
     * Attributes to be applied to the icon
     *
     * @var Array[array]
     */
    private $attributes = array();

    /**
     * Store a collection of icons
     *
     * @var Array[string]
     */
    public $collection = array();

    /**
     * Stores icon stack
     *
     * @var string
     */
    public $stack;

    /**
     * Status of stacking or regular icon
     *
     * @var boolean
     */
    private $stacking = false;

    /**
     * Stores unordered list
     *
     * @var string
     */
    public $list;

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
     * @throws BadLabelException
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
     * Adds an attribute to the icon, useful for title or id
     *
     * @since  1.0.6
     * @param  string $attr Which attribute to add
     * @param  string $val The value of the attribute
     * @return $this
     * @throws InvalidArgumentException
     */
    public function addAttr($attr, $val)
    {
        if (is_string($attr) == false || is_string($val) === false) {
            throw new InvalidArgumentException();
        }

        $this->attributes[$attr] = $val;

        return $this;
    }

    /**
     * Batch adds an attributes to the icon
     *
     * @since  1.0.6
     * @param  array $attrs Array of attributes to add
     * @return $this
     * @throws InvalidArgumentException
     */
    public function addAttrs(array $attrs)
    {
        foreach ($attrs as $attr => $val) {
            $this->addAttr($attr, $val);
        }

        return $this;
    }

    /**
     * Stores icon to be rendered later
     *
     * @param  string $label Label of icon to save in collection
     * @return self
     * @throws BadLabelException       If $label is not a string
     * @throws CollectionIconException If store() method called without defining an icon
     */
    public function store($label)
    {
        if ($this->currentIcon === null) {
            throw new CollectionIconException(
                'There was no icon defined to store.'
            );
        }

        if (is_string($label) === false || empty($label) === true) {
            throw new BadLabelException(
                'Collection icon label must be a non-empty string.'
            );
        }

        $this->collection[$label] = $this->output();

        return $this;
    }

    /**
     * Alias method for store()
     *
     * @codeCoverageIgnore
     * @param  string $label Label of icon to save in collection
     * @return self
     * @throws BadLabelException       If $label is not a string
     * @throws CollectionIconException If store() method called without defining an icon
     */
    public function set($label)
    {
        return $this->store($label);
    }

    /**
     * Retrieve icon from collection
     *
     * @param  string $label Icon label used in store method
     * @throws BadLabelException If $label is not a string
     * @throws CollectionIconException If icon $label is not set
     * @return string HTML icon string
     */
    public function collection($label)
    {
        if (is_string($label) === false) {
            throw new BadLabelException(
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
     * @param  string $label Icon label used in store method
     * @throws BadLabelException If $label is not a string
     * @throws CollectionIconException If icon $label is not set
     * @return string HTML icon string
     */
    public function get($label)
    {
        return $this->collection($label);
    }

    /**
     * Sets which icon to use
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function icon($icon)
    {
        return $this->setIcon($icon);
    }

    /**
     * Alias method for the icon()
     *
     * @codeCoverageIgnore
     * @since  1.0.6
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function i($icon)
    {
        return $this->icon($icon);
    }

    /**
     * Adds extra classes to icon or stack
     *
     * @param  string $class CSS class
     * @return self
     * @throws BadLabelException If $class is not a string
     */
    public function addClass($class)
    {
        if (is_array($class) && count($class) > 0) {
            foreach ($class as $c) {
                $this->appendClass($c);
            }
        } else {
            $this->appendClass($class);
        }

        return $this;
    }

    /**
     * Sets the icon or stack to be a fixed width
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function fixedWidth($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-fw';

        return $this;
    }

    /**
     * Alias method for fixedWidth()
     *
     * @codeCoverageIgnore
     * @since  1.0.6
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function fw($icon = null)
    {
        return $this->fixedWidth($icon);
    }

    /**
     * Sets the icon or stack to be larger
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function lg($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->appendClass('fa-lg');

        return $this;
    }

    /**
     * Sets the icon or stack to be 2 times larger
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function x2($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->appendClass('fa-2x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 3 times larger
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function x3($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->appendClass('fa-3x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 4 times larger
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function x4($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->appendClass('fa-4x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 5 times larger
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function x5($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->appendClass('fa-5x');

        return $this;
    }

    /**
     * Sets the icon or stack to be inverted in color
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function inverse($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-inverse';

        return $this;
    }

    /**
     * Sets the icon or stack to be rotated 90 degrees
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function rotate90($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-rotate-90';

        return $this;
    }

    /**
     * Alias method for the rotate90()
     *
     * @codeCoverageIgnore
     * @since  1.0.6
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function r90($icon = null)
    {
        return $this->rotate90($icon);
    }

    /**
     * Sets the icon or stack to be rotated 180 degrees
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function rotate180($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-rotate-180';

        return $this;
    }

    /**
     * Alias method for rotate180()
     *
     * @codeCoverageIgnore
     * @since  1.0.6
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function r180($icon = null)
    {
        return $this->rotate180($icon);
    }

    /**
     * Sets the icon or stack to be rotated 270 degrees
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function rotate270($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-rotate-270';

        return $this;
    }

    /**
     * Alias method for rotate270()
     *
     * @codeCoverageIgnore
     * @since  1.0.6
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function r270($icon = null)
    {
        return $this->rotate270($icon);
    }

    /**
     * Sets the icon or stack to be flipped horizontally
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function flipHorizontal($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-flip-horizontal';

        return $this;
    }

    /**
     * Alias method for flipHorizontal()
     *
     * @codeCoverageIgnore
     * @since  1.0.6
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function fh($icon = null)
    {
        return $this->flipHorizontal($icon);
    }

    /**
     * Sets the icon or stack to be flipped vertically
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function flipVertical($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-flip-vertical';

        return $this;
    }

    /**
     * Alias method for flipVertical()
     *
     * @codeCoverageIgnore
     * @since  1.0.6
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function fv($icon = null)
    {
        return $this->flipVertical($icon);
    }

    /**
     * Sets the icon to spin
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function spin($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-spin';

        return $this;
    }

    /**
     * Sets a border around the icon
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function border($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-border';

        return $this;
    }

    /**
     * Pulls the icon to the left
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a string
     */
    public function left($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'pull-left';

        return $this;
    }

    /**
     * Pulls the icon to the left
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException
     */
    public function right($icon = null)
    {
        if ($icon !== null) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'pull-right';

        return $this;
    }

    /**
     * Builds unordered list with icons
     *
     * @param  string $icon Default icon used in list (optional)
     * @return self
     * @throws \Khill\Fontawesome\Exceptions\IncompleteListException
     * @throws \Khill\Fontawesome\IncompleteListException
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

        return $this;
    }

    /**
     * Adds items to unordered list with icons
     *
     * @param  string|Array[string] $icon Adds a line or lines to the unordered list
     * @return self
     * @throws IncompleteListException
     */
    public function li($icon = null)
    {
        if (is_string($icon) === false && is_array($icon) === false) {
            throw new IncompleteListException(
                'List items must be a string or array of strings.'
            );
        }

        if (is_string($icon)) {
            $this->list->addItem($icon);
        }

        if (is_array($icon)) {
            $this->list->addItems($icon);
        }

        return $this;
    }

    /**
     * Sets the top icon to be used in a stack
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException If $icon is not a non empty string
     */
    public function stack($icon)
    {
        if (is_string($icon) === false) {
            throw new BadLabelException('Icon label must be a non empty string.');
        }

        $this->stacking = true;
        $this->stack = new FontAwesomeStack();
        $this->stack->setTopIcon($icon);

        return $this;
    }

    /**
     * Sets the bottom icon to be used in a stack
     *
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException        If $icon is not a non empty string
     * @throws IncompleteStackException If The on() method was called without the stack() method
     */
    public function on($icon)
    {
        if (!$this->stacking) {
            throw new IncompleteStackException(
                'Stacks must be started with the stack() method.'
            );
        }

        if (is_string($icon) === false) {
            throw new BadLabelException('Icon label must be a string.');
        }

        $this->stack->setBottomIcon($icon);

        return $this;
    }

    /**
     * Sets icon label
     *
     * @access private
     * @param  string $icon Icon label, omitting the "fa-" prefix
     * @return self
     * @throws BadLabelException
     */
    private function setIcon($icon)
    {
        if (is_string($icon) === false) {
            throw new BadLabelException('Icon label must be a string.');
        }

        $this->currentIcon = $icon;

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
        $attrs = '';
        $classes = 'fa-' . $this->currentIcon;

        if (!empty($this->classes)) {
            foreach ($this->classes as $class) {
                $classes .= ' ' . $class;
            }
        }

        if (!empty($this->attributes)) {
            foreach ($this->attributes as $attr => $val) {
                $attrs .= ' ' . $attr . '="' . $val . '"';
            }
        }

        return sprintf(self::ICON_HTML, $classes, $attrs);
    }

    /**
     * Adds classes to icon or stack object
     *
     * @access private
     * @param  string $class
     * @return self
     * @throws BadLabelException
     */
    private function appendClass($class)
    {
        if (is_string($class) === false) {
            throw new BadLabelException(
                'Additional classes must be non empty strings.'
            );
        }

        if ($this->stacking === true) {
            $this->stack->addClass($class);
        } else {
            $this->classes[] = $class;
        }

        return $this;
    }

    /**
     * Resets the FontAwesome class
     *
     * @access private
     * @return void
     */
    private function reset()
    {
        $this->currentIcon = null;
        $this->stackTop    = null;
        $this->iconBottom  = null;
        $this->list        = null;
        $this->stack       = null;
        $this->stacking    = false;
        $this->classes     = array();
    }

    /**
     * Checks if running in composer environment
     *
     * This will true if the folder 'composer' is within the path to FontAwesomePHP.
     *
     * @access private
     * @since  1.0.6
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
