<?php

namespace Supercluster\Gravity;

use Respect\Rest\Routable;
use Respect\Rest\AbstractRoute;

class Resource implements Routable
{
    protected $links = array();

    public function get()
    {
        return [
            'links' => $this->links
        ];
    }

    public function addLink($rel, $url)
    {
        if (!is_array($this->links[$rel])) {
            $this->links[$rel] = array();
        }
        if (is_array($url)) {
            $this->links[$rel] = array_merge($this->links[$rel], $url);
        }
        $this->links[$rel] = array_unique($this->links[$rel]);
    }

    public function getLink($rel)
    {
        if (!is_array($this->links[$rel])) {
            return array();
        }

        return $this->links[$rel];
    }
}
