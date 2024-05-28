<?php

namespace App\Support\Address\Utils;

class Governorate extends AbstructCountryGovernorateCity {
    public $id, $name_ar, $name_en;
    private $data;
    public function __construct(object $object = null)
    {
        $this->id = $object->governorate_id;
        $this->name_ar = $object->governorate_name_ar;
        $this->name_en = $object->governorate_name_en;
        $this->data = $object->governorate_data;
    }
    public function getData() : array|string|null
    {
        return $this->data;
    }
    public function setObj(object $object) : self
    {
        return new self($object);
    }
}