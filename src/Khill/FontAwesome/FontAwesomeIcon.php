<?php namespace Khill\FontAwesome;

class FontAwesomeIcon {

    /**
     * Html sprintf template to build the icon
     */
    const ICON_HTML = '<i class="fa %s"></i>';

    /**
     * Stores the name of the icon
     *
     * @var string
     */
    protected $icon = '';

    /**
     * Stores the extra classes to be applied to the icon
     *
     * @var array
     */
    protected $extra = array();

    public function __constructor($icon = '')
    {
        $this->icon = $icon;
    }

    public function __toString()
    {
        $icon = 'fa-' . $this->icon;

        if( ! empty($this->extra))
        {
            foreach($this->extra as $class)
            {
                $icon .= ' ' . $class;
            }
        }

        return sprintf($this->iconHtml, $icon);
    }

    public function icon($icon = '')
    {
        $output = $this->_buildTag($icon);
        $this->_reset();

        return $output;
    }

    public function fixedWidth($icon = '')
    {
        $this->_addClass('fa-fw');

        return empty($icon) ? $this : $this->icon($icon);
    }

    public function lg($icon = '')
    {
        $this->_addClass('fa-lg');

        return $this;
    }

    public function x2($icon = '')
    {
        $this->_addClass('fa-2x');

        return $this;
    }

    public function x3($icon = '')
    {
        $this->_addClass('fa-3x');

        return $this;
    }

    public function x4($icon = '')
    {
        $this->_addClass('fa-4x');

        return $this;
    }

    public function x5($icon = '')
    {
        $this->_addClass('fa-5x');

        return $this;
    }

    public function invert($icon = '')
    {
        $this->_addClass('fa-inverse');

        return empty($icon) ? $this : $this->icon($icon);
    }

    public function rotate90($icon = '')
    {
        $this->_addClass('fa-rotate-90');

        return empty($icon) ? $this : $this->icon($icon);
    }

    public function rotate180($icon = '')
    {
        $this->_addClass('fa-rotate-180');

        return empty($icon) ? $this : $this->icon($icon);
    }

    public function rotate270($icon = '')
    {
        $this->_addClass('fa-rotate-270');

        return empty($icon) ? $this : $this->icon($icon);
    }

    public function flipHorizontal($icon = '')
    {
        $this->_addClass('fa-flip-horizontal');

        return empty($icon) ? $this : $this->icon($icon);
    }

    public function flipVertical($icon = '')
    {
        $this->_addClass('fa-flip-vertical');

        return empty($icon) ? $this : $this->icon($icon);
    }

    public function stack($extra)
    {

    }

    private function _reset()
    {
        $this->extra = '';
    }

    private function _addClass($class)
    {
        $this->extra .= ' ' . $class;
    }

    private function _buildTag($icon)
    {
        $icon = 'fa-' . $icon . $this->extra;

        return sprintf($this->iconHtml, $icon);
    }

    private function _buildStack($top, $bottom)
    {

    }

}
