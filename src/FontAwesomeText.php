<?php

namespace Khill\FontAwesome;
use InvalidArgumentException;

/**
 * FontAwesomeText builds a text layer to include in a set of layers
 *
 * @package   Khill\FontAwesome
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesomeText extends FontAwesomeHtmlEntity
{
    /**
     * Html string template to build the icon
     */
    const TEXT_HTML = '<span class="%s"%s%s>%s</span>';

    /**
     * FontAwesomeText constructor.
     *
     * @param string $text    The text to display
     */
    public function __construct($text = null)
    {
        if (!is_string($text)) {
            throw new \InvalidArgumentException(
                'Icon text must be a string.'
            );
        }

        $this->text = $text;
    }

    /**
     * Outputs the FontAwesomeText object as an HTML string
     *
     * @access protected
     * @return string HTML string of text element
     */
    protected function output()
    {
        $attrs   = '';
        $classes = 'fa-layers-text';
        $transforms = '';

        if (!empty($this->classes) && count($this->classes) > 0) {
            $classes .= ' ' . implode(' ', $this->classes);
        }

        if (!empty($this->attributes) && count($this->attributes) > 0) {
            foreach ($this->attributes as $attr => $val) {
                $attrs .= ' ' . $attr . '="' . $val . '"';
            }
        }

        if (!empty($this->transforms) && count($this->transforms) > 0) {
            $transformList = array();
            foreach ($this->transforms as $transform) {
                $transformList[] = implode('-', $transform);
            }
            $transforms = ' data-fa-transform="' . implode(' ', $transformList) . '"';
        }

        return sprintf(self::TEXT_HTML, $classes, $attrs, $transforms, $this->text);
    }
}
