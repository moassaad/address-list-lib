<?php

namespace App\Traits;

use App\Support\Address\AddressCode;

trait AddressCodeTrait {
    
    public function getCountry(string $code)
    {
        return AddressCode::country($code)->name();
    }
    public function getState(string $countryCode, string $code)
    {
        return AddressCode::governorate($countryCode, $code)->name();
    }
    public function getCity(string $countryCode, string $statecode, string $code)
    {
        return AddressCode::city($countryCode, $statecode, $code)->name();
    }
}