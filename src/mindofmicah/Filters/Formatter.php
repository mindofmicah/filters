<?php
namespace mindofmicah\Filters;
use Exception;

class Formatter
{
    protected $factory;
    protected $rules;

    public function __construct(Factory $factory, $rules = '')
    {
        $this->factory = $factory;
        $this->rules = $rules;
    }

    public function formatAsWhereClause()
    {
        if ($this->rules == '') {
            return '';
        }

        $ret = '';
        foreach (explode("\n", $this->rules) as $index => $rule) {
            if ($rule == '') {
                continue;
            }
            try {
                if (preg_match('%^(or|and) (.+)$%', $rule, $match)) {
                    $rule = $match[2];
                    $ret.= ' ' . strtoupper($match[1]) . ' ';
                }
                $ret.= $this->factory->createAsSQL($rule);
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return $ret;
    }
    
    public function setRules($rules)
    {
        $this->rules = trim($rules);
        return $this;
    }

    public function getRules()
    {
        return $this->rules;
    }
}
