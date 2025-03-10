<?php

namespace Moassaad\Addressia\Models;

use Moassaad\Addressia\Collection\CityCollection;
use Moassaad\Addressia\Enums\JsonStructure\GovernorateStruct;

class Governorate extends Model
{
    private $data;

    public function __construct(array $governorate = null)
    {
        $this->data = [];
        $this->defination($governorate);
    }
    protected function defination(array $governorate)
    {
        $this->setId($governorate[GovernorateStruct::ID->value]);
        $this->setNameEn($governorate[GovernorateStruct::NAME_EN->value]);
        $this->setNameAr($governorate[GovernorateStruct::NAME_AR->value]);
        $this->setData($governorate[GovernorateStruct::DATA->value]);
        return $this;
    }

    // public function setObj(object $object) : self
    // {
    //     return new self($object);
    // }
    protected function setData(array $data)
    {
        $this->data = $data;
    }
    public function getData() : array|string|null
    {
        return $this->data;
    }
    public function cities()
    {
        return new CityCollection($this->getData());
    }
}
