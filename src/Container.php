<?php

namespace Supercluster\Gravity;

use Respect\Config\Container as RespectContainer;
use Respect\Config\Instantiator;

class Container extends RespectContainer
{
    /** Respect\Config issue with reusing indexes **/
    protected function parseValue($value)
    {
        if ($value instanceof Instantiator) {
            return $value;
        } elseif (is_array($value)) {
            return $this->parseSubValues($value);
        } elseif (empty($value)) {
            return null;
        } else {
            return $this->parseSingleValue($value);
        }
    }

    /** Respect\Config issue with namespaced references **/
    protected function matchReference(&$value)
    {
        if (preg_match('/^\[([[:alnum:]\\\\]+)\]$/', $value, $match)) {
            return (boolean) ($value = $match[1]);
        }
    }
}
