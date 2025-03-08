<?php

namespace Moassaad\Addressia\Models;

use Moassaad\Addressia\Enums\JsonStructure\CityStruct;

class City extends Model
{

    public function __construct(array $city = null)
    {
        $this->defination($city);
    }
    protected function defination(array $city)
    {
        $this->setId($city[CityStruct::ID->value]);
        $this->setNameEn($city[CityStruct::NAME_EN->value]);
        $this->setNameAr($city[CityStruct::NAME_AR->value]);
        return $this;
    }
}
