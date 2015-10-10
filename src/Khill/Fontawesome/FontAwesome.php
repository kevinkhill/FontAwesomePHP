<?php namespace Khill\Fontawesome;

/**
* FontAwesomePHP is a library that wraps the FontAwesome icon set into easy to use php methods
*
* @package  FontAwesomePHP
* @author   Kevin Hill <kevinkhill@gmail.com>
* @version  1.0.3
* @access   public
* @see      http://kevinkhill.github.io/FontAwesomePHP
*/

use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;
use Khill\Fontawesome\Exceptions\IncompleteStackException;
use Khill\Fontawesome\Exceptions\IncompleteListException;

class FontAwesome {

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
     * @var array
     */
    private $classes = array();

    /**
     * Store a collection of icons
     *
     * @var array
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
        $this->_setIcon($icon);
    }

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @access public
     * @return string HTML string of icon or stack
     */
    public function __toString()
    {
        if(is_a($this->stack, 'Khill\Fontawesome\FontAwesomeStack'))
        {
            $output = $this->stack->output();
        } elseif(is_a($this->list, 'Khill\Fontawesome\FontAwesomeList')) {
            $output = $this->list->output();
        } else {
            $output = $this->_buildIcon();
        }

        $this->_reset();

        return $output;
    }

    /**
     * Stores icon to be rendered later
     *
     * @access public
     * @param  string $label Label of icon to save in collection
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $label is not a string
     * @throws Khill\Fontawesome\Exceptions\CollectionIconException If store() method called without defining an icon
     * @return void
     */
    public function store($label)
    {
        if(empty($this->iconLabel))
        {
            throw new CollectionIconException('There was no icon defined to store.');
        } else {
            if(is_string($label))
            {
                if( ! empty($label))
                {
                    $this->collection[$label] = $this->_buildIcon();
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
     * @access public
     * @param  string $label Icon label used in store method
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $label is not a string
     * @throws Khill\Fontawesome\Exceptions\CollectionIconException If icon $label is not set
     * @return string HTML icon string
     */
    public function collection($label)
    {
        if(is_string($label))
        {
            if(isset($this->collection[$label]))
            {
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
     * Adds extra classes to icon or stack
     *
     * @access public
     * @param string $class CSS class
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $class is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function addClass($class)
    {
        if(is_array($class) && count($class) > 0)
        {
            foreach($class as $c) {
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
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function fixedWidth($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-fw';

        return $this;
    }

    /**
     * Sets the icon or stack to be larger
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function lg($icon = '')
    {
        $this->_setIcon($icon);
        $this->_addClass('fa-lg');

        return $this;
    }

    /**
     * Sets the icon or stack to be 2 times larger
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x2($icon = '')
    {
        $this->_setIcon($icon);
        $this->_addClass('fa-2x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 3 times larger
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x3($icon = '')
    {
        $this->_setIcon($icon);
        $this->_addClass('fa-3x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 4 times larger
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x4($icon = '')
    {
        $this->_setIcon($icon);
        $this->_addClass('fa-4x');

        return $this;
    }

    /**
     * Sets the icon or stack to be 5 times larger
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function x5($icon = '')
    {
        $this->_setIcon($icon);
        $this->_addClass('fa-5x');

        return $this;
    }

    /**
     * Sets the icon or stack to be inverted in color
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function inverse($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-inverse';

        return $this;
    }

    /**
     * Sets the icon or stack to be rotated 90 degrees
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function rotate90($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-rotate-90';

        return $this;
    }

    /**
     * Sets the icon or stack to be rotated 180 degrees
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function rotate180($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-rotate-180';

        return $this;
    }

    /**
     * Sets the icon or stack to be rotated 270 degrees
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function rotate270($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-rotate-270';

        return $this;
    }

    /**
     * Sets the icon or stack to be flipped horizontally
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function flipHorizontal($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-flip-horizontal';

        return $this;
    }

    /**
     * Sets the icon or stack to be flipped vertically
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function flipVertical($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-flip-vertical';

        return $this;
    }

    /**
     * Sets the icon to spin
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function spin($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-spin';

        return $this;
    }

    /**
     * Sets a border around the icon
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function border($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-border';

        return $this;
    }

    /**
     * Pulls the icon to the left
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function left($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'pull-left';

        return $this;
    }

    /**
     * Pulls the icon to the left
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function right($icon = '')
    {
        $this->_setIcon($icon);
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

        if(is_string($iconLabel) && ! empty($iconLabel))
        {
            $this->list->setDefaultIcon($iconLabel);
        } elseif(is_array($iconLabel) && count($iconLabel) > 0) {
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
        if(is_string($iconLine) && ! empty($iconLine))
        {
            $this->list->addItem($iconLine);
        } elseif(is_array($iconLine) && count($iconLine) > 0){
            $this->list->addItems($iconLine);
        } else {
            throw new IncompleteListException('List must items must be a non empty string or array of strings.');
        }

        return $this;
    }

    /**
     * Sets the top icon to be used in a stack
     *
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a non empty string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function stack($icon)
    {
        if(is_string($icon) && ! empty($icon))
        {
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
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a non empty string
     * @throws Khill\Fontawesome\Exceptions\IncompleteStackException If The on() method was called without the stack() method
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function on($icon)
    {
        if($this->stacking === true)
        {
            if(is_string($icon) && ! empty($icon))
            {
                $this->stack->setBottomIcon($icon);

                return $this;
            } else {
                throw new BadLabelException('Icon label must be a non empty string.');
            }
        } else {
            throw new IncompleteStackException('Stacks must be started with the stack() method.');
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
     * Adds classes to icon or stack object
     *
     * @access private
     * @return void
     */
    private function _addClass($class)
    {
        if(is_string($class) && ! empty($class))
        {
            if($this->stacking === true)
            {
                $this->stack->addClass($class);
            } else {
                $this->classes[] = $class;
            }
        } else {
            throw new BadLabelException('Additional classes must be non empty strings.');
        }
    }

    /**
     * Resets the FontAwesome class
     *
     * @access private
     * @return void
     */
    private function _reset()
    {
        $this->iconLabel  = '';
        $this->stackTop   = '';
        $this->iconBottom = '';
        $this->list       = null;
        $this->stack      = null;
        $this->stacking   = false;
        $this->classes    = array();
    }

}
