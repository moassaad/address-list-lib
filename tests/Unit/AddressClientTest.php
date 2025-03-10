<?php

namespace Moassaad\Addressia\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Moassaad\Addressia\Models\City;
use Moassaad\Addressia\Models\Model;
use Moassaad\Addressia\AddressClient;
use Moassaad\Addressia\Models\Country;
use Moassaad\Addressia\Models\Governorate;
use Moassaad\Addressia\Enums\JsonStructure\ModelFlag;
use Moassaad\Addressia\Enums\JsonStructure\CityStruct;
use Moassaad\Addressia\Enums\JsonStructure\CountryStruct;
use Moassaad\Addressia\Enums\JsonStructure\GovernorateStruct;

class AddressClientTest extends TestCase
{
    private array $data;
    private array $dataset;
    private string $dataget;

    protected function setUp(): void
    {
        $this->data = [
                "country_id"=>"1",
                "country_name_ar"=>"مصر",
                "country_name_en"=>"Egypt",
                "country_data"=>[
                    "governorate_id"=>"1",
                    "governorate_name_ar"=>"القاهرة",
                    "governorate_name_en"=>"Cairo",
                    "governorate_data"=>[
                        "city_id"=>"56",
                        "city_name_ar"=>"النزهة الجديدة",
                        "city_name_en"=>"New Nozha"
                    ],
                ],
        ];
        $this->dataget = '{"country":"1","governorate":"1","city":"56","address":"street 10th of zo-elhega"}';
        $this->dataset = json_decode($this->dataget, JSON_OBJECT_AS_ARRAY);
    }
    public function test_get_address_from_database()
    {

        $address = new AddressClient($this->dataget);

        $this->assertEqualsCountryTest($address);

        $this->assertEqualsGovernorateTest($address);

        $this->assertEqualsCityTest($address);
        
        $this->assertEquals($this->dataset[ModelFlag::ADDRESS->value], $address->getAddress());
    }
    public function test_set_address_to_database()
    {

        $getAddress = AddressClient::get($this->dataget);

        $this->assertInstanceOf(AddressClient::class, $getAddress);

        $address = AddressClient::set($this->dataset);

        $this->assertEquals($this->dataget, $address);

    }
    private function assertEqualsCountryTest(AddressClient $address)
    {
        $country = $address->getCountry();
        
        $this->assertInstanceOf(Country::class, $country);
        $this->assertInstanceOf(Model::class, $country);
        $this->assertEquals($this->data[CountryStruct::ID->value], $country->id());
        $this->assertEquals($this->data[CountryStruct::NAME_AR->value], $country->name_ar());
        $this->assertEquals($this->data[CountryStruct::NAME_EN->value], $country->name_en());

    }
    private function assertEqualsGovernorateTest(AddressClient $address)
    {
        $governorate = $address->getGovernorate();
        $data = $this->data[CountryStruct::DATA->value] ;
        
        $this->assertInstanceOf(Governorate::class, $governorate);
        $this->assertInstanceOf(Model::class, $governorate);
        $this->assertEquals($data[GovernorateStruct::ID->value], $governorate->id());
        $this->assertEquals($data[GovernorateStruct::NAME_AR->value], $governorate->name_ar());
        $this->assertEquals($data[GovernorateStruct::NAME_EN->value], $governorate->name_en());

    }
    private function assertEqualsCityTest(AddressClient $address)
    {
        $city = $address->getCity();
        $data = $this->data[CountryStruct::DATA->value][GovernorateStruct::DATA->value] ;
        
        $this->assertInstanceOf(City::class, $city);
        $this->assertInstanceOf(Model::class, $city);
        $this->assertEquals($data[CityStruct::ID->value], $city->id());
        $this->assertEquals($data[CityStruct::NAME_AR->value], $city->name_ar());
        $this->assertEquals($data[CityStruct::NAME_EN->value], $city->name_en());

    }
}
