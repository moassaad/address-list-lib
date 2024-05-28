<?php

namespace App\Support\Address;
use App\Support\Address\Utils\City;

class AddressCity {
    private $citys = null;
    private $city = null;
    public function __construct($stdClass) 
    {
        $this->citys = $stdClass;
    }
    public function list() : array
    {
        return $this->citys->getData();
    }
    public function code($code) : object|null
    {
        foreach ($this->citys->getData() as $city)
        {
            if($city->city_id == $code)
            {
                $this->city = new City($city);
                return $this;
            }
        }
        return $this;
    }
    // public function id() : string
    // {
    //     return $this->city->id();
    // }
    // public function name_en() : string
    // {
    //     return $this->city->name_en();
    // }
    // public function name_ar() : string
    // {
    //     return $this->city->name_ar();
    // }
    public function name(string $lang = "en") : string
    {
        if($lang === "ar")
        {
            return $this->city->name_ar();
        }
        return $this->city->name_en();
    }
    public function findWithName(string $name) : object|null
    {
        foreach ($this->citys->getData() as $city)
        {
            if($city->city_name_en === $name || $city->city_name_ar === $name)
            {
                $this->city = new City($city);
                return $this;
            }
        }
        return $this;
    }
    public function setCity(object $object)
    {
        $this->city = new City($object);
        return $this;
    }
    public function getCity() : City
    {
        return $this->city;
    }
    public function listCity() : array|object|null
    {
        $list = null;
        foreach($this->list() as $Obj)
        {
            $list[] = $this->setCity($Obj)->getCity();
        }
        return $list;
    }
    public function check($code) : bool
    {
        $flag = false;
        foreach($this->listCity() as $Obj)
        {
            if($Obj->id() == $code)
            {
                $flag = true;
                return $flag;
            }
        }
        return $flag;
    }
}