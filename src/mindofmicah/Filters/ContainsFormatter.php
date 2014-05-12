<?php

namespace mindofmicah\Filters;

class ContainsFormatter implements FormatableInterface
{
    protected $orig;

    public function __construct($argument1)
    {
        $this->orig = $argument1;
    }

    public function formatAsSQL()
    {
        $search = '%(.+) contains "(.+)"%';
        $replace = '$1 LIKE "%$2%"';
        return preg_replace($search, $replace, trim($this->orig));
    }
}
