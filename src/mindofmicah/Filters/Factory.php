<?php

namespace mindofmicah\Filters;

class Factory
{

    public function create($argument1)
    {

        if (strpos($argument1, '=')) {
            return new EqualFormatter($argument1);
        }
        
        if (strpos($argument1, 'contains')) {
            return new ContainsFormatter($argument1);
        }

        if (strpos($argument1, 'begins with')) {
            return new BeginsWithFormatter($argument1);
        }
        throw new \Exception($argument1 . ' is not a valid rule');
    }

    public function createAsSQL($argument1)
    {
        $rule = $this->create($argument1);
        return $rule->formatAsSQL();
    }
}
