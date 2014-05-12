<?php

namespace mindofmicah\Filters;

class BeginsWithFormatter implements FormatableInterface
{
    public function formatAsSQL()
    {
        $search = '%([\S]+)\s+begins with\s+"(.+)"%';
        $replace = '$1 LIKE "$2%"';
        return preg_replace($search, $replace, trim($this->orig));
    }

    public function __construct($orig)
    {
        $this->orig = $orig;
    }
}
