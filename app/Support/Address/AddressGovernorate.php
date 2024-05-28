<?php

namespace App\Support\Address;
use App\Support\Address\Utils\Governorate;

class AddressGovernorate {
    private $governorates = null;
    private $governorate = null;
    public function __construct($stdClass) 
    {
        $this->governorates = $stdClass;
    }
    public function list() : array
    {
        return $this->governorates;
    }
    public function code(int|string $code) : object
    {
        $this->governorate = new Governorate($this->governorates[$code]);
        return $this;
    }
    // public function id() : string
    // {
    //     return $this->governorate->id();
    // }
    // public function name_en() : string
    // {
    //     return $this->governorate->name_en();
    // }
    // public function name_ar() : string
    // {
    //     return $this->governorate->name_ar();
    // }
    public function name(string $lang = "en") : string
    {
        if($lang === "ar")
        {
            return $this->governorate->name_ar();
        }
        return $this->governorate->name_en();
    }
    public function findWithName(string $name) : object|null
    {
        foreach ($this->governorates as $governorate)
        {
            if($governorate->governorate_name_en === $name || $governorate->governorate_name_ar === $name)
            {
                $this->governorate = $governorate;
                return $this;
            }
        }
        return $this;
    }
    public function city(int $code = null) : AddressCity
    {
        $city =  new AddressCity($this->governorate);
        if($code !== null) 
        {
            return $city->code($code);
        }
        return $city;
    }
    public function setGovernorate(object $object)
    {
        $this->governorate = new Governorate($object);
        return $this;
    }
    public function getGovernorate() : Governorate
    {
        return $this->governorate;
    }
    public function listGovernorate() : array|object|null
    {
        $list = null;
        foreach($this->list() as $Obj)
        {
            $list[] = $this->setGovernorate($Obj)->getGovernorate();
        }
        return $list;
    }
    public function check($code) : bool
    {
        $flag = false;
        foreach($this->listGovernorate() as $Obj)
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