<?php

namespace App\Models\Traits;

use App\Helpers\StdClass;

trait DataTrait
{
    private $dataTr;

    public static function dataBoot()
    {
        self::saving(function ($r) {
            //need to prime the pump
            if (empty($r->dataTr) and isset($r->attributes['data'])) {
                $r->getDataAttribute($r->attributes['data']);
            }
            $r->data = json_encode($r->dataTr);
        });
    }

    /*public function */
    public function getDataAttribute($v)
    {
        if (!$this->dataTr) {
            $this->dataTr = new StdClass($v);
        }

        return $this->dataTr;
    }

    public function data($k = null, $v = null)
    {
        if (!$this->dataTr) {
            $this->dataTr = new StdClass($this->data);
        }

        if (is_null($k)) {
            return $this->dataTr;
        }

        if ($k and is_null($v)) {
            return property_exists($this->dataTr, $k) ? $this->dataTr->$k : null;
        }

        if ($k and !is_null($v)) {
            $this->dataTr->$k = $v;
        }
    }
}
