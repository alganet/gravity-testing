<?php

namespace Supercluster\Gravity;

use Respect\Rest\Routes\Factory;
use Respect\Config\Instantiator;

class Route extends Factory
{
    public function __construct($method, $pattern, Instantiator $resource)
    {
        parent::__construct(
            $method,
            $pattern,
            $resource->getClassName(),
            array($resource, 'getInstance')
        );
    }
}
