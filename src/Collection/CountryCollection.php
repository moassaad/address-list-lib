<?php

namespace Moassaad\Addressia\Collection;

use Moassaad\Addressia\Enums\JsonStructure\FileStruct;
use Moassaad\Addressia\Models\Country;

class CountryCollection
{
    /**
     * Array of collection primary data.
     * @var array $collection
     */
    private array $collection;

    /**
     * Array of collection country data.
     * @var array<Country> $countries
     */
    private array $countries;

    /**
     * Summary of country
     * @var Country|null $country
     */
    private ?Country $country;
    public function __construct(array $collection) 
    {
        $this->country = null;
        $this->collection = $collection;
        $this->build();
    }
    protected function build()
    {
        foreach($this->list() as $country)
        {
            $this->setCountries($country);
        }
    }
    public function setCountry(Country $country)
    {
        $this->country = $country;
        return $this;
    }
    public function setNewCountry(array $country)
    {
        $this->country = new Country($country);
        return $this;
    }
    public function getCountry()
    {
        return $this->country;
    }
    public function setCountries(array $country)
    {
        $this->countries[] = new Country($country);
        return $this;
    }
    public function getCountries()
    {
        return $this->countries;
    }
    public function list(): array
    {
        return $this->collection[FileStruct::DATA->value];
    }
    public function findCode(int $code)
    {
        $this->setNewCountry($this->collection[FileStruct::DATA->value][$code]);
        return $this;
    }
    public function findName(string $name)
    {
        foreach ($this->getCountries() as $country)
        {
            if($this->isNameExists($country, $name))
            {
                $this->setCountry($country);
                return $this;
            }
        }
        return $this;
    }
    protected function isNameExists(Country $country, string $name)
    {
        return ($country->name_en() === $name || $country->name_ar() === $name);
    }
    public function find(string $id)
    {
        foreach ($this->getCountries() as $country)
        {
            if($this->isIdExists($country, $id))
            {
                $this->setCountry($country);
                return $this;
            }
        }
        return $this;
    }
    protected function isIdExists(Country $country, string $id)
    {
        return ($country->id() === $id);
    }
}