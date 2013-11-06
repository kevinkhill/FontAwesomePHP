<?php namespace Khill\Fontawesome;

use Khill\Fontawesome\Exceptions;

class FontAwesome {

    const CDN_LINK = '<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css" rel="stylesheet">';

    /**
     * Html sprintf template to build the icon
     */
    const ICON_HTML = '<i class="fa %s"></i>';

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
     * Assigns the name to the icon
     *
     * @param  string $icon Icon label
     * @return FontAwesome FontAwesome object
     */
    public function __construct($icon = '')
    {
        return $this->_setIcon($icon);
    }

    public static function cdnLink()
    {
        return self::CDN_LINK;
    }

    public function __toString()
    {
        $classes = 'fa-' . $this->iconLabel;

        if( ! empty($this->classes))
        {
            foreach($this->classes as $class)
            {
                $classes .= ' ' . $class;
            }
        }

        $outputHtml = sprintf(self::ICON_HTML, $classes);

        $this->_reset();

        return $outputHtml;
    }

    public function icon($icon)
    {
        return $this->_setIcon($icon);
    }

    public function addClass($class)
    {
        $this->classes[] = $class;

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

    public function inverted($icon = '')
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

    public function stack($top, $bottom, $extraClasses = '')
    {
        //fa-stack-2x
    }

    private function _setIcon($icon)
    {
        if( ! empty($icon))
        {
            $this->iconLabel = $icon;
        }

        return $this;
    }

    private function _reset()
    {
        $this->iconLabel = '';
        $this->classes   = array();

        return $this;
    }

}
