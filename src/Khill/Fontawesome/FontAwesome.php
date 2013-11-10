<?php namespace Khill\Fontawesome;

use Khill\Fontawesome\Exceptions\BadLabelException;
use Khill\Fontawesome\Exceptions\CollectionIconException;

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
     * @return FontAwesome FontAwesome object
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

    public function icon($icon)
    {
        $this->_setIcon($icon);
        
        return $this;
    }

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

    public function fixedWidth($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-fw';

        return $this;
    }

    public function lg($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-lg';

        return $this;
    }

    public function x2($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-2x';

        return $this;
    }

    public function x3($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-3x';

        return $this;
    }

    public function x4($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-4x';

        return $this;
    }

    public function x5($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-5x';

        return $this;
    }

    public function inverse($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-inverse';

        return $this;
    }

    public function rotate90($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-rotate-90';

        return $this;
    }

    public function rotate180($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-rotate-180';

        return $this;
    }

    public function rotate270($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-rotate-270';

        return $this;
    }

    public function flipHorizontal($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-flip-horizontal';

        return $this;
    }

    public function flipVertical($icon = '')
    {
        $this->_setIcon($icon);
        $this->classes[] = 'fa-flip-vertical';

        return $this;
    }

    public function stack($icon)
    {
        $this->_setIcon($icon);

        return $this;
    }

    public function on($icon)
    {
        $this->stackTop = $this->_buildIcon();
        $this->_setIcon($icon);

        return $this;
    }


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
