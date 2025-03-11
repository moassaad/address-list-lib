<?php

namespace Moassaad\Addressia;

use Moassaad\Addressia\Factory\AddressListFactory;
use function json_decode;

use Moassaad\Addressia\Models\City;
use Moassaad\Addressia\Models\Country;
use Moassaad\Addressia\Models\Governorate;
use Moassaad\Addressia\Factory\AddressFactory;
use Moassaad\Addressia\Enums\JsonStructure\ModelFlag;

class AddressClient
{
    protected Country $country;
    protected Governorate $governorate;
    protected City $city;
    protected string $address;
    protected string $country_id, $governorate_id, $city_id;
    protected string $line_one, $line_two, $allAddress;
    protected AddressFactory $addressFactory;
    protected AddressListFactory $addressListFactory;
    public function __construct(string $address = "", string $space = ' ')
    {
        $this->setDefault();
        $this->buildAddressList();
        $this->build($address, $space);
    }
    private function setDefault()
    {
        // $this->country = new Country();
        // $this->governorate = new Governorate();
        // $this->city = new City();
        
        $this->country_id = "";
        $this->governorate_id = "";
        $this->city_id = "";
        $this->address = "";

        $this->line_one = "";
        $this->line_two = "";
        $this->allAddress = "";
    }
    private function buildAddressList()
    {
        $this->addressListFactory = new AddressListFactory();
    }
    private function build(string $address, $space = ' ')
    {
        $addressArray =  $this->jsonToArray($address);
        if(!empty($addressArray))
        {
            $this->buildFactory($addressArray);
            $this->buildAddress($addressArray, $space);
        }
    }
    private function jsonToArray(string $address): array
    {
        return json_decode($address, JSON_OBJECT_AS_ARRAY) ?? [];
    }
    private function buildFactory(array $address)
    {
        $this->addressFactory = new AddressFactory($address);
        $this->country = $this->addressFactory->getCountry();
        $this->governorate = $this->addressFactory->getGovernorate();
        $this->city = $this->addressFactory->getCity();
    }
    private function buildAddress(array $address, string $space)
    {
        $this->country_id = $address[ModelFlag::COUNTRY->value];
        $this->governorate_id = $address[ModelFlag::GOVERNORATE->value];
        $this->city_id = $address[ModelFlag::CITY->value];
        $this->address = $address[ModelFlag::ADDRESS->value];

        $this->line_one = $this->getLineOne($space);
        $this->line_two = $this->getLineTwo();
        $this->allAddress = $this->getAllAddress($space);
    }
    public static function get(string $address, string $space = ' ')
    {
        return new self($address, $space);
    }
    public static function set(array $address): string
    {
        return json_encode($address);
    }
    public function getCountry(): Country
    {
        return $this->country;
    }
    public function getGovernorate(): Governorate
    {
        return $this->governorate;
    }
    public function getCity(): City
    {
        return $this->city;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    private function getLineOne($space = ' ') : string
    {
        return  $this->getCountry()->name().$space.
                $this->getGovernorate()->name().$space.
                $this->getCity()->name();
    }
    private function getLineTwo() : string
    {
        return  $this->getAddress();
    }
    private function getAllAddress($space = ' ') : string
    {
        return  $this->getLineOne($space).$space.
                $this->getLineTwo();
    }
    public function getAddressList()
    {
        return $this->addressListFactory;
    }
}