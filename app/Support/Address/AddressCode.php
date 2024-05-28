<?php

namespace App\Support\Address;


class AddressCode {

    /**
     * @param int $code
     * @return AddressGovernorate()
    */
    
    public static function country(int|string $code = null) : AddressCountry
    {
        $country = new AddressCountry(self::readFileJson('address.json'));
        if($code !== null)
        {
            return $country->code($code);
        }
        return $country;
    }
    public static function governorate($countryCode, $code = null) {
        $governorate = self::country($countryCode)->governorate();
        if($code !== null)
        {
            return $governorate->code($code);
        }
        return $governorate;
    }
    public static function city($countryCode, $governorateCode, $cityCode = null) {
        return self::country($countryCode)->governorate($governorateCode)->city($cityCode);
    }
    public static function readFileJson(string $filename ,string $path = 'data_store/address/')
    {
        $linkFile = storage_path($path.$filename);
        $file = file_get_contents($linkFile);
        $fileJson = json_decode($file);
        return $fileJson;
    }
    public static function get() {
        $linkFile = storage_path('data_store/address/governorates.json');
        $file = file_get_contents($linkFile);
        $fileJson = json_decode($file);
        return $fileJson;
    }
}