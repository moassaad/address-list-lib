<?php

namespace Moassaad\Addressia\Collection;

use Moassaad\Addressia\Enums\JsonStructure\FileStruct;
use Moassaad\Addressia\Models\Country;

class CountryCollection extends ModelCollection
{
    public function __construct(array $collection) 
    {
        parent::__construct($collection);
    }
    protected function build()
    {
        foreach($this->list() as $country)
        {
            $this->addToCollection(new Country($country));
        }
    }
    public function list(): array
    {
        return $this->list[FileStruct::DATA->value];
    }
    protected function setNewCountry(array $country)
    {
        $this->setModel(new Country($country));
        return $this;
    }
    /**
     * Country Model.
     * @return \Moassaad\Addressia\Models\Country|null
     */
    public function getCountry():?Country
    {
        return $this->getModel();
    }
    /**
     * Array of country.
     * @return array<\Moassaad\Addressia\Models\Country>
     */
    public function getCountries()
    {
        return $this->getCollection();
    }
    public function findCode(int $code)
    {
        $this->setNewCountry($this->list()[$code]);
        return $this;
    }
}