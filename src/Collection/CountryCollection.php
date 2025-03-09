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
    protected function setNewCountry(array $country)
    {
        $this->setModel(new Country($country));
        return $this;
    }
    public function getCountry()
    {
        return $this->getModel();
    }
    public function getCountries()
    {
        return $this->getCollection();
    }
    public function list(): array
    {
        return $this->list[FileStruct::DATA->value];
    }
    public function findCode(int $code)
    {
        $this->setNewCountry($this->list()[$code]);
        return $this;
    }
}