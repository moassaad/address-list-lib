<?php

namespace App\Support\Address\Utils;

class City extends AbstructCountryGovernorateCity {
    public $id, $name_ar, $name_en;
    public function __construct(object $object = null)
    {
        $this->id = $object->city_id;
        $this->name_ar = $object->city_name_ar;
        $this->name_en = $object->city_name_en;
    }
    
    public function setObj(object $object) : self
    {
        return new self($object);
    }
}