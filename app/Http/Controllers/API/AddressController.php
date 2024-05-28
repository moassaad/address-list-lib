<?php

namespace App\Http\Controllers\API;
use App\Support\Address\AddressCode;

class AddressController
{
    public function countryList()
    {
        $list = [];
        $countryObj = AddressCode::country();
        foreach($countryObj->list() as $countryObje)
        {
            $country = $countryObj->setCountry($countryObje);
            $list[] = $country->getCountry();
        }
        return response($list);
    }
    public function countryCode($code)
    {
        return response([AddressCode::country($code)->getCountry()]);
    }
    public function governorateList($countryCode)
    {
        $list = [];
        $governorateObj = AddressCode::governorate($countryCode);
        foreach($governorateObj->list() as $governorateObje)
        {
            $list[] = $governorateObj->setGovernorate($governorateObje)->getGovernorate();
        }
        return response($list);
    }
    public function governorateCode($countryCode, $code)
    {
        return response([AddressCode::governorate($countryCode, $code)->getGovernorate()]);
    }
    public function cityList($countryCode, $governorateCode)
    {
        $list = [];
        $cityObj = AddressCode::city($countryCode, $governorateCode);
        foreach($cityObj->list() as $cityObje)
        {
            $list[] = $cityObj->setCity($cityObje)->getCity();
        }
        return response($list);
    }
    public function cityCode($countryCode, $governorateCode, $code)
    {
        return response([AddressCode::city($countryCode, $governorateCode, $code)->getCity()]);
    }
}
