<?php

namespace Moassaad\Addressia\Tests\Unit\CollectionTest;

use Moassaad\Addressia\Collection\CountryCollection;
use Moassaad\Addressia\Collection\GovernorateCollection;
use Moassaad\Addressia\Enums\JsonStructure\FileStruct;
use Moassaad\Addressia\Enums\JsonStructure\CountryStruct;
use Moassaad\Addressia\Enums\JsonStructure\GovernorateStruct;
use Moassaad\Addressia\Enums\Language\LanguageFlag;
use Moassaad\Addressia\Factory\AddressFile;
use Moassaad\Addressia\Models\Governorate;
use PHPUnit\Framework\TestCase;

class GovernorateCollectionTest extends TestCase
{
    private $collectData;
    private $country;

    protected function setUp(): void
    {
        $this->collectData = new AddressFile();
        $this->country = new CountryCollection($this->collectData->getContent());
        $this->collectData = $this->collectData->getContent()[FileStruct::DATA->value];
    }
    private function assertEqualsTest($governorateData, $country)
    {
        $this->assertEquals($governorateData[GovernorateStruct::ID->value], $country->id());
        $this->assertEquals($governorateData[GovernorateStruct::NAME_EN->value], $country->name_en());
        $this->assertEquals($governorateData[GovernorateStruct::NAME_AR->value], $country->name_ar());
        $this->assertEquals($governorateData[GovernorateStruct::NAME_EN->value], $country->name());
        $this->assertEquals($governorateData[GovernorateStruct::NAME_AR->value], $country->name(LanguageFlag::AR->value));
        $this->assertEquals($governorateData[GovernorateStruct::DATA->value], $country->getData());
    }
    public function test_governorates_collection()
    {

        $governorate = new GovernorateCollection($this->country->findName("Egypt")->getCountry()->getData());
        $governorateData = $this->collectData[1][CountryStruct::DATA->value];
        
        $this->assertEquals($governorateData, $governorate->list());    
        $this->assertEqualsTest($governorateData[1], $governorate->find(1)->getGovernorate());
        $this->assertEqualsTest($governorateData[1], $governorate->findName("Cairo")->getGovernorate());
        $this->assertContainsOnlyInstancesOf(Governorate::class, $governorate->getGovernorates());
        
    }
    public function test_not_found_governorate()
    {
        
        $governorate = new GovernorateCollection($this->country->findName("Egypt")->getCountry()->getData());
        $governorateData = $this->collectData[1][CountryStruct::DATA->value];
        
        $this->assertEquals($governorateData, $governorate->list());
        $this->assertEquals(null, $governorate->find(100)->getGovernorate());
        $this->assertEquals(null, $governorate->findName("Governorate")->getGovernorate());

    }
}
