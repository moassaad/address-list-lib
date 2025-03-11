<?php

namespace Moassaad\Addressia\Collection;

use Moassaad\Addressia\Models\Model;

abstract class ModelCollection
{
    /**
     * Array of collection primary data.
     * @var array $list
     */
    protected array $list;

    /**
     * Array of collection governorate data.
     * @var array<Model> $collection
     */
    protected array $collection;

    /**
     * Summary of governorate
     * @var Model|null $model
     */
    protected ?Model $model;
    public function __construct(array $list) 
    {
        $this->model = null;
        $this->list = $list;
        $this->build();
    }
    abstract protected function build();
    protected function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }
    protected function getModel()
    {
        return $this->model;
    }
    protected function addToCollection(Model $model)
    {
        $this->collection[] = $model;
        return $this;
    }
    protected function getCollection()
    {
        return $this->collection;
    }
    public function find(string $id)
    {
        foreach ($this->getCollection() as $model)
        {
            if($this->isIdExists($model, $id))
            {
                $this->setModel($model);
                return $this;
            }
        }
        return $this;
    }
    protected function isIdExists(Model $model, string $id)
    {
        return ($model->id() === $id);
    }
    public function findName(string $name)
    {
        foreach ($this->getCollection() as $model)
        {
            if($this->isNameExists($model, $name))
            {
                $this->setModel($model);
                return $this;
            }
        }
        return $this;
    }
    protected function isNameExists(Model $model, string $name)
    {
        return ($model->name_en() === $name || $model->name_ar() === $name);
    }
}
