<?php

namespace Moassaad\Addressia\Tests\Unit\CollectionTest;

use PHPUnit\Framework\TestCase;
use Moassaad\Addressia\Models\City;
use Moassaad\Addressia\Factory\AddressFile;
use Moassaad\Addressia\Collection\CityCollection;
use Moassaad\Addressia\Enums\Language\LanguageFlag;
use Moassaad\Addressia\Collection\CountryCollection;
use Moassaad\Addressia\Enums\JsonStructure\CityStruct;
use Moassaad\Addressia\Enums\JsonStructure\FileStruct;
use Moassaad\Addressia\Collection\GovernorateCollection;
use Moassaad\Addressia\Enums\JsonStructure\CountryStruct;
use Moassaad\Addressia\Enums\JsonStructure\GovernorateStruct;

class CityCollectionTest extends TestCase
{
    private $collectData;
    private $country;
    private $governorate;

    protected function setUp(): void
    {
        $this->collectData = new AddressFile();
        $this->country = (new CountryCollection($this->collectData->getContent()))->findName("Egypt")->getCountry();
        $this->governorate = new GovernorateCollection($this->country->getData());
        $this->collectData = $this->collectData->getContent()[FileStruct::DATA->value];
    }
    private function assertEqualsTest($cityData, $city)
    {
        $this->assertEquals($cityData[CityStruct::ID->value], $city->id());
        $this->assertEquals($cityData[CityStruct::NAME_EN->value], $city->name_en());
        $this->assertEquals($cityData[CityStruct::NAME_AR->value], $city->name_ar());
        $this->assertEquals($cityData[CityStruct::NAME_EN->value], $city->name());
        $this->assertEquals($cityData[CityStruct::NAME_AR->value], $city->name(LanguageFlag::AR->value));
    }
    public function test_cities_collection()
    {

        $city = new CityCollection($this->governorate->findName("Cairo")->getGovernorate()->getData());
        $cityData = $this->collectData[1][CountryStruct::DATA->value][1][GovernorateStruct::DATA->value];

        $this->assertEquals($cityData, $city->list());    
        $this->assertEqualsTest($cityData[55], $city->find(56)->getCity());
        $this->assertEqualsTest($cityData[55], $city->findName("New Nozha")->getCity());
        $this->assertContainsOnlyInstancesOf(City::class, $city->getCities());
        
    }
    public function test_not_found_city()
    {
        $city = new CityCollection($this->governorate->findName("Cairo")->getGovernorate()->getData());
        $cityData = $this->collectData[1][CountryStruct::DATA->value][1][GovernorateStruct::DATA->value];
        
        $this->assertEquals($cityData, $city->list());
        $this->assertEquals(null, $city->find(100)->getCity());
        $this->assertEquals(null, $city->findName("City")->getCity());

    }
}
