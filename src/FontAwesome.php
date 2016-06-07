<?php

namespace Khill\Fontawesome;

use Khill\Fontawesome\FontAwesomeList;
use Khill\Fontawesome\FontAwesomeStack;
use Khill\Fontawesome\Support\Psr4Autoloader;
use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;
use Khill\Fontawesome\Exceptions\IncompleteStackException;
use Khill\Fontawesome\Exceptions\IncompleteListException;

/**
* FontAwesomePHP is a library that wraps the FontAwesome icon set into easy to use php methods
*
* @package  FontAwesomePHP
* @author   Kevin Hill <kevinkhill@gmail.com>
* @version  1.0.6
* @see      http://kevinkhill.github.io/FontAwesomePHP
*/
class FontAwesome
{
    /**
     * FontAwesomePHP version
     */
    const VERSION = '1.0.6';

    /**
     * HTML Link tag to the FontAwesome CDN
     */
    const CDN_LINK = '<link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">';

    /**
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="fa %s"></i>';

    /**
     * Html string template to build the icon stack
     */
    const STACK_HTML = '<span class="%s">%s%s</span>';

    /**
     * Name of the icon
     *
     * @var string
     */
    private $iconLabel = '';

    /**
     * Classes to be applied to the icon
     *
     * @var Array[string]
     */
    private $classes = array();

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
     * HTML link to the FontAwesome CSS file through the bootstrapcdn
     *
     * @see http://www.bootstrapcdn.com/
     * @return string HTML link element
     */
    public static function css()
    {
        return self::CDN_LINK;
    }

    /**
     * Assigns the name to the icon
     *
     * @param  string $icon Icon label
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function __construct($icon = '')
    {
        if (!$this->usingComposer()) {
            require_once(__DIR__.'/Support/Psr4Autoloader.php');

            $loader = new Psr4Autoloader;
            $loader->register();
            $loader->addNamespace('Khill\Fontawesome', __DIR__);
        }

        if ($this->nonEmptyString($icon)) {
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
            $output = $this->buildIcon();
        }

        $this->reset();

        return $output;
    }

    /**
     * Stores icon to be rendered later
     *
     * @param  string $label Label of icon to save in collection
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $label is not a string
     * @throws Khill\Fontawesome\Exceptions\CollectionIconException If store() method called without defining an icon
     * @return void
     */
    public function store($label)
    {
        if (empty($this->iconLabel)) {
            throw new CollectionIconException('There was no icon defined to store.');
        } else {
            if (is_string($label)) {
                if (! empty($label)) {
                    $this->collection[$label] = $this->buildIcon();
                } else {
                    throw new BadLabelException('Cannot store icon into collection with an empty label.');
                }
            } else {
                throw new BadLabelException('Collection icon label must be a string.');
            }
        }
    }

    /**
     * Retrieve icon from collection
     *
     * @param  string $label Icon label used in store method
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $label is not a string
     * @throws Khill\Fontawesome\Exceptions\CollectionIconException If icon $label is not set
     * @return string HTML icon string
     */
    public function collection($label)
    {
        if (is_string($label)) {
            if (isset($this->collection[$label])) {
                return $this->collection[$label];
            } else {
                throw new CollectionIconException('Collection icon "' . $label . '" does not exist.');
            }
        } else {
            throw new BadLabelException('Collection icon label must be a string.');
        }
    }

    /**
     * Sets which icon to use
     *
     * @param  string $icon Icon label, ommiting fa- prefix
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function icon($icon)
    {
        $this->setIcon($icon);

        return $this;
    }

    /**
     * Adds extra classes to icon or stack
     *
     * @param  string $class CSS class
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $class is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function addClass($class)
    {
        if (is_array($class) && count($class) > 0) {
            foreach ($class as $c) {
                $this->_addClass($c);
            }
        } else {
            $this->_addClass($class);
        }

        return $this;
    }

    /**
     * Sets the icon or stack to be a fixed width
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function fixedWidth($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-fw';

        return $this;
    }

    /**
     * Sets the icon or stack to be larger
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function lg($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->_addClass('fa-lg');

        return $this;
    }

    /**
     * Sets the icon or stack to be 2 times larger
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x2($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->_addClass('fa-2x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 3 times larger
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x3($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->_addClass('fa-3x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 4 times larger
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x4($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->_addClass('fa-4x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 5 times larger
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x5($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->_addClass('fa-5x');

        return $this;
    }

    /**
     * Sets the icon or stack to be inverted in color
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function inverse($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-inverse';

        return $this;
    }

    /**
     * Sets the icon or stack to be rotated 90 degrees
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function rotate90($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-rotate-90';

        return $this;
    }

    /**
     * Sets the icon or stack to be rotated 180 degrees
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function rotate180($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-rotate-180';

        return $this;
    }

    /**
     * Sets the icon or stack to be rotated 270 degrees
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function rotate270($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-rotate-270';

        return $this;
    }

    /**
     * Sets the icon or stack to be flipped horizontally
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function flipHorizontal($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-flip-horizontal';

        return $this;
    }

    /**
     * Sets the icon or stack to be flipped vertically
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function flipVertical($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-flip-vertical';

        return $this;
    }

    /**
     * Sets the icon to spin
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function spin($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-spin';

        return $this;
    }

    /**
     * Sets a border around the icon
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function border($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'fa-border';

        return $this;
    }

    /**
     * Pulls the icon to the left
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function left($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'pull-left';

        return $this;
    }

    /**
     * Pulls the icon to the left
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function right($icon = '')
    {
        if ($this->nonEmptyString($icon)) {
            $this->setIcon($icon);
        }

        $this->classes[] = 'pull-right';

        return $this;
    }

    /**
     * Builds unordered list with icons
     *
     * @param  string $iconLabel Default icon used in list (optional)
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function ul($iconLabel = '')
    {
        $this->list = new FontAwesomeList();

        if (is_string($iconLabel) && ! empty($iconLabel)) {
            $this->list->setDefaultIcon($iconLabel);
        } elseif (is_array($iconLabel) && count($iconLabel) > 0) {
            $this->list->setListItems($iconLabel);
        } else {
            throw new IncompleteListException('List must have a default icon or associative array with icons as keys.');
        }

        return $this;
    }

    /**
     * Adds items to unordered list with icons
     *
     * @param  string|array $iconLine Adds a line or lines to the unordered list
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function li($iconLine = '')
    {
        if (is_string($iconLine) && ! empty($iconLine)) {
            $this->list->addItem($iconLine);
        } elseif (is_array($iconLine) && count($iconLine) > 0) {
            $this->list->addItems($iconLine);
        } else {
            throw new IncompleteListException('List must items must be a non empty string or array of strings.');
        }

        return $this;
    }

    /**
     * Sets the top icon to be used in a stack
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a non empty string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function stack($icon)
    {
        if (is_string($icon) && ! empty($icon)) {
            $this->stacking = true;
            $this->stack = new FontAwesomeStack();
            $this->stack->setTopIcon($icon);

            return $this;
        } else {
            throw new BadLabelException('Icon label must be a non empty string.');
        }
    }

    /**
     * Sets the bottom icon to be used in a stack
     *
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a non empty string
     * @throws Khill\Fontawesome\Exceptions\IncompleteStackException If The on() method was called without the stack() method
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function on($icon)
    {
        if (!$this->stacking) {
            throw new IncompleteStackException('Stacks must be started with the stack() method.');
        }

        if (!is_string($icon) || empty($icon)) {
            throw new BadLabelException('Icon label must be a non empty string.');
        }

        $this->stack->setBottomIcon($icon);

        return $this;
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
        if ($this->nonEmptyString($icon) === false) {
            throw new BadLabelException('Icon label must be a string.');
        }

        $this->iconLabel = $icon;
    }

    /**
     * Builds the icon from the template
     *
     * @access private
     * @return string
     */
    private function buildIcon()
    {
        $classes = 'fa-' . $this->iconLabel;

        if (!empty($this->classes)) {
            foreach ($this->classes as $class) {
                $classes .= ' ' . $class;
            }
        }

        return sprintf(self::ICON_HTML, $classes);
    }

    /**
     * Adds classes to icon or stack object
     *
     * @access private
     * @return void
     */
    private function _addClass($class)
    {
        if ($this->nonEmptyString($class) === false) {
            throw new BadLabelException('Additional classes must be non empty strings.');
        }

        if ($this->stacking === true) {
            $this->stack->addClass($class);
        } else {
            $this->classes[] = $class;
        }
    }

    /**
     * Resets the FontAwesome class
     *
     * @access private
     * @return void
     */
    private function reset()
    {
        $this->iconLabel  = '';
        $this->stackTop   = '';
        $this->iconBottom = '';
        $this->list       = null;
        $this->stack      = null;
        $this->stacking   = false;
        $this->classes    = array();
    }

    /**
     * This will true if the given input is a non-empty string, otherwise false.
     *
     * @access private
     * @since  1.0.6
     * @param  string $str String to check
     * @return boolean
     */
    private function nonEmptyString($str)
    {
        return (is_string($str) && ! empty($str));
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
