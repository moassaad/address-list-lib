<?php

namespace Moassaad\Addressia\Collection;


use Moassaad\Addressia\Models\Governorate;

class GovernorateCollection extends ModelCollection
{
    public function __construct(array $collection) 
    {
        parent::__construct($collection);
    }
    protected function build()
    {
        foreach($this->list() as $model)
        {
            $this->addToCollection(new Governorate($model));
        }
    }
    public function list(): array
    {
        return $this->list;
    }
    public function setGovernorate(array $governorate)
    {
        $this->setModel(new Governorate($governorate));
        return $this;
    }
    public function getGovernorate()
    {
        return $this->getModel();
    }
    public function getGovernorates()
    {
        return $this->getCollection();
    }
}
