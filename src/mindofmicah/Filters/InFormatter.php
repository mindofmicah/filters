<?php

namespace mindofmicah\Filters;

class InFormatter implements FormatableInterface
{
    protected $orig;    
    public function formatAsSQL()
    {
        return substr(str_replace('in ', 'IN(', $this->orig), 0, -1) . '")';
    }

    public function __construct($argument1)
    {
        $this->orig = trim($argument1);
    }
}
