<?php

namespace Moassaad\Addressia\Tests\Unit\CollectionTest;

use Moassaad\Addressia\Collection\CountryCollection;
use Moassaad\Addressia\Enums\JsonStructure\CountryStruct;
use Moassaad\Addressia\Enums\JsonStructure\FileStruct;
use Moassaad\Addressia\Enums\Language\LanguageFlag;
use Moassaad\Addressia\Factory\AddressFile;
use Moassaad\Addressia\Models\Country;
use PHPUnit\Framework\TestCase;

class CountryCollectionTest extends TestCase
{
    private $collectData;

    protected function setUp(): void
    {
        $this->collectData = new AddressFile();
    }
    private function assertEqualsTest($countryData, $country)
    {
        $this->assertEquals($countryData[CountryStruct::ID->value], $country->id());
        $this->assertEquals($countryData[CountryStruct::NAME_EN->value], $country->name_en());
        $this->assertEquals($countryData[CountryStruct::NAME_AR->value], $country->name_ar());
        $this->assertEquals($countryData[CountryStruct::NAME_EN->value], $country->name());
        $this->assertEquals($countryData[CountryStruct::NAME_AR->value], $country->name(LanguageFlag::AR->value));
        $this->assertEquals($countryData[CountryStruct::DATA->value], $country->getData());
    }
    public function test_countries_collection()
    {
        
        $listCountries = $this->collectData->getContent()[FileStruct::DATA->value];
        $countries = new CountryCollection($this->collectData->getContent());
        $countryData = $listCountries[1];
        
        $this->assertEquals($listCountries, $countries->list());    
        $this->assertEqualsTest($countryData, $countries->find(1)->getCountry());
        $this->assertEqualsTest($countryData, $countries->findCode(1)->getCountry());        
        $this->assertEqualsTest($countryData, $countries->findName("Egypt")->getCountry());
        $this->assertContainsOnlyInstancesOf(Country::class, $countries->getCountries());

    }
    public function test_not_found_country()
    {
        
        $listCountries = $this->collectData->getContent()[FileStruct::DATA->value];
        $countries = new CountryCollection($this->collectData->getContent());
        
        $this->assertEquals($listCountries, $countries->list());
        $this->assertEquals(null, $countries->find(2)->getCountry());
        $this->assertEquals(null, $countries->findName("Country")->getCountry());

    }
    
}
