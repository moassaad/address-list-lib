<?php

namespace Moassaad\Addressia\Factory;

use Moassaad\Addressia\Collection\CountryCollection;
use Moassaad\Addressia\Collection\GovernorateCollection;

class AddressListFactory
{
    protected $countries;
    protected $governorates;
    protected $cities;
    protected $data;
    public function __construct()
    {
        $addressFile = new AddressFile();
        $this->data = $addressFile->getContent();
    }
    protected function countriesFactory()
    {
        $this->setCountries((new CountryCollection($this->data))->getCountries());
        return $this;
    }
    protected function setCountries(array $countries)
    {
        $this->countries = $countries;
        return $this;
    }
    /**
     * Array of country.
     * @return array<\Moassaad\Addressia\Models\Country>
     */
    public function getCountries(): array
    {
        $this->countriesFactory();
        return $this->countries;
    }
    protected function governoratesFactory(string $country_id)
    {
        $country = (new CountryCollection($this->data))->find($country_id)->getCountry();
        $this->setGovernorates($country->governorates()->getGovernorates());
        return $this;
    }
    protected function setGovernorates(array $governorates)
    {
        $this->governorates = $governorates;
        return $this;
    }
    /**
     * Array of governorate.
     * @param string $governorate_id
     * @return array<\Moassaad\Addressia\Models\Governorate>
     */
    public function getGovernorates(string $governorate_id): array
    {
        $this->governoratesFactory($governorate_id);
        return $this->governorates;
    }
    protected function citiesFactory(string $country_id, string $governorate_id)
    {
        $country = (new CountryCollection($this->data))->find($country_id)->getCountry();
        $governorate = $country->governorates()->find($governorate_id)->getGovernorate();
        $this->setCities($governorate->cities()->getCities());
        return $this;
    }
    protected function setCities(array $cities)
    {
        $this->cities = $cities;
        return $this;
    }
    /**
     * Array of city.
     * @return array<\Moassaad\Addressia\Models\City>
     */
    public function getCities(string $country_id, string $governorate_id): array
    {
        $this->citiesFactory($country_id, $governorate_id);
        return $this->cities;
    }
}
