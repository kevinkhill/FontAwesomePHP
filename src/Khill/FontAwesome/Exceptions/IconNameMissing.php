<?php namespace Khill\Fontawesome;

class IconNameMissing extends Exception
{
    public function __toString() {
        return __CLASS__ . ": [1]: Icon Name Missing: You must provide a valid icon name.\n";
    }

}
