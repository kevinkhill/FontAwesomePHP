<?php namespace Khill\Fontawesome;

use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;
use Khill\Fontawesome\Exceptions\IncompleteStackException;

class FontAwesome {

    const CDN_LINK = '<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css" rel="stylesheet">';

    /**
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="fa %s"></i>';

    /**
     * Html string template to build the icon stack
     */
    const STACK_HTML = '<span class="fa-stack%s">%s%s</span>';

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
     * Status of stacking or regular icon
     *
     * @var boolean
     */
    private $stacking = false;

    /**
     * Stores top icon in a stack
     *
     * @var string
     */
    public $stackTop = '';

    /**
     * Stores bottom icon in a stack
     *
     * @var string
     */
    public $stackBottom = '';

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
     * HTML link to the FontAwesome CSS file through the bootstrapcdn
     *
     * @return string HTML link element
     */
    public static function css()
    {
        return self::CDN_LINK;
    }

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @return string HTML string
     */
    public function __toString()
    {
        if( ! empty($this->stackTop) &&  empty($this->stackBottom))
        {
            return $this->_buildStack();
        } else {
            return $this->_buildIcon();
        }
    }

    /**
     * Stores icon to be rendered later
     * 
     * @param  string $label Label of icon to save in collection
     * @return void
     */
    public function store($label)
    {
        if(is_string($label))
        {
            if( ! empty($label))
            {
                $this->collection[$label] = $this->_buildIcon();
            } else {
                throw new BadLabelException('Error: Cannot store icon into collection with an empty label.');
            }
        } else {
            throw new BadLabelException('Error: Collection icon label must be a string.');
        }
    }

    /**
     * Retrieve icon from collection
     * 
     * @param  string $label Icon label used in store method
     * @return void
     */
    public function collection($label)
    {
        if(is_string($label))
        {
            if(isset($this->collection[$label]))
            {
                return $this->collection[$label];
            } else {
                throw new CollectionIconException('Error: Collection icon "$label" does not exist.');
            }
        } else {
            throw new BadLabelException('Error: Collection icon label must be a string.');
        }
    }

    /**
     * Sets which icon to use
     * 
     * @param  string $icon Icon label, ommiting fa- prefix
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
            throw new BadLabelException('Error: Additional classes must be a string.');
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
        $this->_setIcon($icon);
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
        $this->_setIcon($icon);
        $this->classes[] = 'fa-lg';

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
        $this->_setIcon($icon);
        $this->classes[] = 'fa-2x';

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
        $this->_setIcon($icon);
        $this->classes[] = 'fa-3x';

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
        $this->_setIcon($icon);
        $this->classes[] = 'fa-4x';

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
        $this->_setIcon($icon);
        $this->classes[] = 'fa-5x';

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
        $this->_setIcon($icon);
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
        $this->_setIcon($icon);
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
        $this->_setIcon($icon);
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
        $this->_setIcon($icon);
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
        $this->_setIcon($icon);
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
        $this->_setIcon($icon);
        $this->classes[] = 'fa-flip-vertical';

        return $this;
    }

    /**
     * Sets the top icon to be used in a stack
     * 
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesome FontAwesome object
     */
    public function stack($icon)
    {
        $this->stacking = true;
        $this->_setIcon($icon);

        return $this;
    }

    /**
     * Sets the bottom icon to be used in a stack
     * 
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
            throw new IncompleteStackException('Error: Stacks must be started with the stack() method.');
        }

        return $this;
    }



/*******************************************
 *            PRIVATE METHODS              *
 *******************************************/
    private function _setIcon($icon)
    {
        if(is_string($icon))
        {
            if( ! empty($icon))
            {
                $this->iconLabel = $icon;
            }
        } else {
            throw new BadLabelException('Error: Icon label must be a string.');
        }
    }

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

        $output = sprintf(self::ICON_HTML, $classes);
        $this->_reset();

        return $output;
    }

    private function _buildStack()
    {
        $this->stackBottom = $this->_buildIcon();
        $this->_setStackPositions();

        $output = sprintf(self::STACK_HTML, '', $this->stackTop, $this->stackBottom);
        $this->_reset(true);

        return $output;
    }

    private function _setStackPositions()
    {
        $this->stackTop    = preg_replace('/"(.*)"/', '"\\1 fa-stack-2x"', $this->stackTop);
        $this->stackBottom = preg_replace('/"(.*)"/', '"\\1 fa-stack-1x"', $this->stackBottom);
    }

    private function _reset($fullReset = false)
    {
        if($fullReset === true)
        {
            $this->iconLabel  = '';
            $this->stackTop   = '';
            $this->iconBottom = '';
            $this->classes    = array();
        } else {
            $this->iconLabel = '';
            $this->classes   = array();
        }
    }

}
