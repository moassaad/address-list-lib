<?php

namespace Moassaad\Addressia\Models;

use Moassaad\Addressia\Collection\GovernorateCollection;
use Moassaad\Addressia\Enums\JsonStructure\CountryStruct;

class Country extends Model
{
    protected $data;

    public function __construct(array $country = [])
    {
        $this->data = [];
        $this->defination($country);
    }
    protected function defination(array $country)
    {
        $this->setId($country[CountryStruct::ID->value]);
        $this->setNameEn($country[CountryStruct::NAME_EN->value]);
        $this->setNameAr($country[CountryStruct::NAME_AR->value]);
        $this->setData($country[CountryStruct::DATA->value]);
        return $this;
    }
    protected function setData(array $data)
    {
        $this->data = $data;
    }
    public function getData() : array
    {
        return $this->data;
    }
    public function governorates()
    {
        return new GovernorateCollection($this->getData());
    }
}
