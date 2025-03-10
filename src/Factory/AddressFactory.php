<?php

namespace Moassaad\Addressia\Factory;

use Moassaad\Addressia\Models\City;
use Moassaad\Addressia\Models\Country;
use Moassaad\Addressia\Models\Governorate;
use Moassaad\Addressia\Collection\CountryCollection;
use Moassaad\Addressia\Enums\JsonStructure\ModelFlag;
use Moassaad\Addressia\Collection\GovernorateCollection;

class AddressFactory
{
    protected $country;
    protected $governorate;
    protected $city;
    protected $data;

    public function __construct(array $address)
    {
        $this->build($address);
    }

    protected function build(array $address)
    {
        $addressFile = new AddressFile();
        $this->data = $addressFile->getContent();
        $this->countryFactory($address[ModelFlag::COUNTRY->value]);
        $this->governorateFactory($address[ModelFlag::GOVERNORATE->value]);
        $this->cityFactory($address[ModelFlag::CITY->value]);
    }
    public function countryFactory(int $id)
    {
        $this->setCountry((new CountryCollection($this->data))->find($id)->getCountry());
        return $this;
    }
    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }
    public function getCountry()
    {
        return $this->country;
    }
    public function governorateFactory(int $id)
    {
        $this->setGovernorate($this->getCountry()->governorates()->find($id)->getGovernorate());
        return $this;
    }
    public function setGovernorate(Governorate $governorate)
    {
        $this->governorate = $governorate;
        return $this;
    }
    public function getGovernorate()
    {
        return $this->governorate;
    }
    public function cityFactory(int $id)
    {
        $this->setCity($this->getGovernorate()->cities()->find($id)->getCity());
        return $this;
    }
    public function setCity(City $city)
    {
        $this->city = $city;
        return $this;
    }
    public function getCity(): City
    {
        return $this->city;
    }
}
