<?php

namespace mindofmicah\Filters;

class EqualFormatter implements FormatableInterface
{
    public function formatAsSQL()
    {
        return trim(preg_replace('%\s*=\s*%', '=', $this->orig, 1));
    }

    public function __construct($argument1)
    {
        $this->orig = $argument1;
    }
}
