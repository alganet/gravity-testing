<?php

namespace Supercluster\Gravity;

use Respect\Relational\Sql as RespectSql;

class Sql extends RespectSql
{
    protected function build($operation, $parts)
    {
        switch ($operation) { //just special cases
            case 'createTableIfNotExists':
                $this->buildFirstPart($parts);
                return $this->buildParts($parts, '(%s) ');
            default: //defaults to any other SQL instruction
                return parent::build($operation, $parts);
        }
    }

}
