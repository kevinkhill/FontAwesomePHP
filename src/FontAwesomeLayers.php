<?php

namespace Khill\FontAwesome;

use Khill\FontAwesome\Exceptions\IncompleteStackException;
use InvalidArgumentException;

/**
 * FontAwesomeLayers builds icon stacks
 *
 * @package   Khill\FontAwesome
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesomeLayers extends FontAwesomeHtmlEntity
{

    /**
     * Html string template to build the icon stack
     */
    const LAYERS_HTML = '<span class="%s">%s</span>';

    /**
     * Html string template to build a counter element
     */
    const COUNTER_HTML = '<span class="%s">%s</span>';

    /**
     * The icons to stack on top of each other
     *
     * @var string
     */
    private $layers = array();

    /**
     * FontAwesomeLayers constructor.
     *
     * @param array  $classes Extra classes to add to the stack of layers
     */
    public function __construct($classes = array())
    {
        $this->classes = $classes;
    }


    public function icon($icon)
    {
        if(!is_object($icon) || get_class($icon) != 'Khill\FontAwesome\FontAwesome')
        {
            throw new \InvalidArgumentException(
                'Only fully-formed icon objects can be added to layers'
            );
        }

        $this->layers[] = $icon;

        return $this;
    }


    public function counter($value, $classes = array())
    {
        $counterClasses = 'fa-layers-counter';

        if (count($classes) > 0) {
            $counterClasses .= ' ' . implode(' ', $classes);
        }

        $element = sprintf(self::LAYERS_HTML, $counterClasses, $value);
        $this->layers[] = $element;

        return $this;
    }


    public function text($text)
    {
        /*
        if(get_class($text) != 'Khill\FontAwesome\FontAwesomeText')
        {
            throw new \InvalidArgumentException(
                'Only fully-formed text objects can be added to layers'
            );
        }*/

        $this->layers[] = $text;

        return $this;
    }

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @access protected
     * @return string HTML string of layers
     * @throws \Khill\FontAwesome\Exceptions\IncompleteStackException
     */
    protected function output()
    {
        if (count($this->layers) == 0) {
            //throw new IncompleteStackException();
        }

        $stackClasses = 'fa-layers fa-fw';

        if (count($this->classes) > 0) {
            $stackClasses .= ' ' . implode(' ', $this->classes);
        }

        $layers = implode('', $this->layers);

        return sprintf(self::LAYERS_HTML, $stackClasses, $layers);
    }
}
