<?php

namespace Moassaad\Addressia\Collection;

use Moassaad\Addressia\Models\City;

class CityCollection extends ModelCollection
{
    public function __construct(array $collection) 
    {
        parent::__construct($collection);
    }
    protected function build()
    {
        foreach($this->list() as $model)
        {
            $this->addToCollection(new City($model));
        }
    }
    public function list(): array
    {
        return $this->list;
    }
    public function setCity(array $city)
    {
        $this->setModel(new City($city));
        return $this;
    }
    public function getCity()
    {
        return $this->getModel();
    }
    public function getCities()
    {
        return $this->getCollection();
    }
}
