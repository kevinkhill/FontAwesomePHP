<?php

namespace Khill\FontAwesome;

use Khill\FontAwesome\Exceptions\IncompleteStackException;

/**
 * FontAwesomeStack builds icon stacks
 *
 * @package   Khill\FontAwesome
 * @author    Kevin Hill <kevinkhill@gmail.com>
 * @copyright (c) 2016, KHill Designs
 * @link      http://github.com/kevinkhill/FontAwesomePHP GitHub Repository Page
 * @link      http://kevinkhill.github.io/FontAwesomePHP  Official Docs Site
 * @license   http://opensource.org/licenses/MIT          MIT
 */
class FontAwesomeStack extends FontAwesomeHtmlEntity
{
    /**
     * Html string template to build the icon
     */
    const ICON_HTML = '<i class="%s fa-%s"></i>';

    /**
     * Html string template to build the icon stack
     */
    const STACK_HTML = '<span class="%s">%s%s</span>';

    /**
     * The top icon of the stack
     *
     * @var string
     */
    private $topIcon = null;

    /**
     * The bottom icon of the stack
     *
     * @var string
     */
    private $bottomIcon = null;

    /**
     * FontAwesomeStack constructor.
     *
     * @param string $icon    The top icon of the stack
     * @param array  $classes Extra classes to add to the top Icon
     */
    public function __construct($icon, array $classes = array(), $style='fas')
    {
        if (is_string($icon) === false) {
            throw new \InvalidArgumentException(
                'Icon label must be a string.'
            );
        }
        if (is_string($style) === false) {
            throw new \InvalidArgumentException(
                'The style label must be a string.'
            );
        }
        if (!in_array($style, $this->STYLES)) {
            throw new \InvalidArgumentException(
                'Invalid style.'
            );
        }

        $iconClasses = $icon . ' fa-stack-2x';

        if (count($classes) > 0) {
            foreach ($classes as $class) {
                $iconClasses .= ' ' . $this->classMapper($class);
            }
        }

        $this->topIcon = sprintf(self::ICON_HTML, $style, $iconClasses);
    }


    /**
     * Finishes the stack after created by the main FontAwesome class stack method
     * creates the stack object.
     *
     * @param  string $icon
     * @param  string $style
     * @param  array $classes
     * @return self
     */
    public function on($icon, array $classes = array(), $style='fas')
    {
        if (is_string($icon) === false) {
            throw new \InvalidArgumentException(
                'Icon label must be a string.'
            );
        }
        if (is_string($style) === false) {
            throw new \InvalidArgumentException(
                'The style label must be a string.'
            );
        }
        if (!in_array($style, $this->STYLES)) {
            throw new \InvalidArgumentException(
                'Invalid style.'
            );
        }

        $iconClasses = $icon . ' fa-stack-1x';

        if (count($classes) > 0) {
            foreach ($classes as $class) {
                $iconClasses .= ' ' . $this->classMapper($class);
            }
        }

        $this->bottomIcon = sprintf(self::ICON_HTML, $style, $iconClasses);

        return $this;
    }

    /**
     * Outputs the FontAwesome object as an HTML string
     *
     * @access protected
     * @return string HTML string of icon or stack
     * @throws \Khill\FontAwesome\Exceptions\IncompleteStackException
     */
    protected function output()
    {
        if ($this->bottomIcon === null) {
            $this->bottomIcon = '';
            //throw new IncompleteStackException();
        }

        $stackClasses = 'fa-stack';

        if (count($this->classes) > 0) {
            $stackClasses .= ' ' . implode(' ', $this->classes);
        }

        return sprintf(self::STACK_HTML, $stackClasses, $this->topIcon, $this->bottomIcon);
    }
}
