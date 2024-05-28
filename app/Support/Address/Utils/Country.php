<?php

namespace App\Support\Address\Utils;

class Country extends AbstructCountryGovernorateCity{
    public $id, $name_ar, $name_en;
    private $data;

    public function __construct(object $object = null)
    {
        $this->id = $object->country_id;
        $this->name_ar = $object->country_name_ar;
        $this->name_en = $object->country_name_en;
        $this->data = $object->country_data;
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