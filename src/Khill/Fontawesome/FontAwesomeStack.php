<?php namespace Khill\Fontawesome;

/**
* FontAwesomeStack builds icon stacks
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

class FontAwesomeStack {

    /**
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="fa %s"></i>';

    /**
     * Html string template to build the icon stack
     */
    const STACK_HTML = '<span class="%s">%s%s</span>';

    /**
     * Classes to be applied to the stack
     *
     * @var array
     */
    private $classes = array();

    /**
     * Stores top icon in a stack
     *
     * @var string
     */
    public $topIcon = '';

    /**
     * Stores bottom icon in a stack
     *
     * @var string
     */
    public $bottomIcon = '';

    /**
     * Stores the HTML to output
     * 
     * @var string
     */
    public $output = '';

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @access public
     * @return string HTML string of icon or stack
     */
    public function __toString()
    {
        $this->output = $this->_buildStack();    

        $this->_reset();
        
        return $output;
    }
  
    /**
     * Sets the top icon to be used in a stack
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
     */
    public function setTopIcon($icon)
    {
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
     */
    public function setBottomIcon($icon)
    {
            $this->topIcon = $this->_buildIcon();
            $this->_setIcon($icon);
        } else {
            throw new IncompleteStackException('Stacks must be started with the stack() method.');
        }

        return $this;
    } 

    /**
     * Sets which icon to use
     * 
     * @access public
     * @param  string $icon Icon label, ommiting fa- prefix
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
     */
    public function addClass($class)
    {
        if(is_string($class))
        {
            $this->classes[] = $class;
        } else {
            throw new BadLabelException('Additional classes must be a string.');
        }

        return $this;
    }

    /**
     * Sets the icon or stack to be a fixed width
     * 
     * @access public
     * @param  string $icon Icon label
     * @throws Khill\Fontawesome\Exceptions\BadLabelException If $icon is not a string
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
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
     * @return Khill\Fontawesome\FontAwesomeStack FontAwesomeStack object
     */
    public function right($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'pull-right';

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

        return sprintf(self::STACK_HTML, $classes, $this->stackTop, $this->stackBottom);
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
    private function _reset()
    {
        $this->iconLabel  = '';
        $this->stackTop   = '';
        $this->iconBottom = '';
        $this->stacking   = false;
        $this->classes    = array();
    }

}
