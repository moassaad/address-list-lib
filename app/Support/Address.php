<?php

namespace App\Support;
use App\Traits\AddressCodeTrait;

class Address {
    use AddressCodeTrait;

    public  $country, $state, $city, $address;
    public  $country_code, $state_code, $city_code;
    public function __construct(string|array|null $address = null)
    {   if(is_string($address))
        {
            self::get($address);
        }elseif (is_array($address))
        {
            $this->country = $address['country'];
            $this->state = $address['state'];
            $this->city = $address['city'];
            $this->address = $address['address'];
            self::set($address);
        }
    }
    private function get($address, $space = " ")
    {
        $_address =  json_decode($address);
        $this->country_code = $_address->country;
        $this->state_code = $_address->state;
        $this->city_code = $_address->city;
        $this->country = self::getCountry($_address->country);
        $this->state = self::getState($_address->country, $_address->state);
        $this->city = self::getCity($_address->country, $_address->state, $_address->city);
        $this->address = $_address->address;
        $this->line_one = $this->getLineOne($space);
        $this->line_two = $this->getLineTwo();
        $this->allAddress = $this->getAllAddress($space);
    }
    public function getAttributes($address, $space = " ")
    {
        self::get($address);
        return $this;
    }
    private function getLineOne($space = " ") : string
    {
        return  $this->country.$space.
                $this->state.$space.
                $this->city;
    }
    private function getLineTwo() : string
    {
        return  $this->address;
    }
    private function getAllAddress($space = " ") : string
    {
        return  $this->getLineOne($space).$space.
                $this->getLineTwo();
    }
    static public function set($address): string
    {
        return json_encode($address);
    }
}