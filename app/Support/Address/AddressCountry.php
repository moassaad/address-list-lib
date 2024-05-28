<?php

namespace App\Support\Address;
use App\Support\Address\Utils\Country;

class AddressCountry {
    private $countrys = null;
    private $country = null;
    public function __construct(object $stdClass) 
    {
        $this->countrys = $stdClass;
    }
    public function list() : array
    {
        return $this->countrys->data;
    }
    public function code(int $code) : object
    {
        $this->country = new Country($this->countrys->data[$code]);
        return $this;
    }
    // public function id() : string
    // {
    //     return $this->country->id();
    // }
    // public function name_en() : string
    // {
    //     return $this->country->name_en();
    // }
    // public function name_ar() : string
    // {
    //     return $this->country->name_ar();
    // }
    public function name(string $lang = "en") : string
    {
        if($lang === "ar")
        {
            return $this->country->name_ar();
        }
        return $this->country->name_en();
    }
    public function findWithName(string $name) : object|null
    {
        foreach ($this->countrys->data as $country)
        {
            if($country->country_name_en === $name || $country->country_name_ar === $name)
            {
                $this->country = $country;
                return $this;
            }
        }
        return $this;
    }
    /**
     * @return AddressGovernorate
     */
    public function governorate(int $code = null) : AddressGovernorate
    {
        $governorate =  new AddressGovernorate($this->country->getData());

        if($code !== null) 
        {
            return $governorate->code($code);
        }
        return $governorate;
    }
    public function setCountry(object $object)
    {
        $this->country = new Country($object);
        return $this;
    }
    public function getCountry() : Country
    {
        return $this->country;
    }
    public function listCountry() : array|object|null
    {
        $list = null;
        foreach($this->list() as $Obj)
        {
            $list[] = $this->setCountry($Obj)->getCountry();
        }
        return $list;
    }
    public function check($code) : bool
    {
        $flag = false;
        foreach($this->listCountry() as $Obj)
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