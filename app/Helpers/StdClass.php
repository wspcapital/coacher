<?php

namespace App\Helpers;

class StdClass
{
    private $parent;

    public function __construct($data = null)
    {
        if ($data and is_string($data)) {
            $data = json_decode($data);
        }
        if ($data and (is_object($data) or is_array($data))) {
            foreach ($data as $k => $v) {
                $this->$k = $v;
            }
        }
    }

    public function &__get($k)
    {
        if (!isset($this->$k)) {
            $this->$k = new StdClass;
        }

        return $this->$k;
    }

    public function __set($k, $v)
    {
        $this->$k = $v;
    }

    public function __toString()
    {
        return '';
    }
}
