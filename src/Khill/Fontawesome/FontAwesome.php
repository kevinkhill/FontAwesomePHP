<?php namespace Khill\Fontawesome;

/**
* Example_Class is a sample class for demonstrating PHPDoc
*
* Example_Class is a class that has no real actual code, but merely
* exists to help provide people with an understanding as to how the
* various PHPDoc tags are used.
*
* Example usage:
* if (Example_Class::example()) {
*    print "I am an example.";
* }
*
* @package  FontAwesomePHP
* @author   Kevin Hill <kevinkhill@gmail.com>
* @version  1.0b1
* @access   public
* @see      http://www.example.com/pear
*/

use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;
use Khill\Fontawesome\Exceptions\IncompleteStackException;

class FontAwesome {

    /**
     * HTML Link tag to the FontAwesome CDN
     */
    const CDN_LINK = '<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css" rel="stylesheet">';

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
     * Classes to be applied to icon stack
     *
     * @var array
     */
    private $stackClasses = array();

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
     * @access public
     * @return string HTML string
     */
    public function __toString()
    {
//        if( ! empty($this->stackTop) &&  empty($this->stackBottom))
//        {
            if( ! empty($this->stackTop) &&  empty($this->stackBottom))
            {
                return $this->_buildStack();
            } else {
                return $this->_buildIcon();
            }
//        } else {
//            throws new IncompleteStackException('Error: The stack is incomplete.');
//        }
    }

    /**
     * Stores icon to be rendered later
     * 
     * @access public
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
     * @access public
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
     * @access public
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
            throw new BadLabelException('Error: Additional classes must be a string.');
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

        if($this->stacking === true)
        {
            $this->stackClasses[] = 'fa-lg';
        } else {
            $this->classes[] = 'fa-lg';
        }

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
        $this->classes[] = 'fa-2x';

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
        $this->classes[] = 'fa-3x';

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
        $this->classes[] = 'fa-4x';

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
        $this->classes[] = 'fa-5x';

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
     * Sets the top icon to be used in a stack
     * 
     * @access public
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
     * @access public
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
            throw new BadLabelException('Error: Icon label must be a string.');
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

        $output = sprintf(self::ICON_HTML, $classes);
        $this->_reset();

        return $output;
    }

    /**
     * Builds the stack from the template
     * 
     * @access private
     * @return void
     */
    private function _buildStack()
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

        $output = sprintf(self::STACK_HTML, $classes, $this->stackTop, $this->stackBottom);
        $this->_reset(true);

        return $output;
    }

    /**
     * Assigns icon possitions in the stack
     * 
     * @access private
     * @return void
     */
    private function _setStackPositions()
    {
        $this->stackTop    = preg_replace('/"(.*)"/', '"\\1 fa-stack-2x"', $this->stackTop);
        $this->stackBottom = preg_replace('/"(.*)"/', '"\\1 fa-stack-1x"', $this->stackBottom);
    }

    /**
     * Resets the FontAwesome class
     * 
     * @access private
     * @return void
     */
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
