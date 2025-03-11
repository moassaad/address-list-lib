# Address List Lib

## Introduction

Address Library is a library used in the Laravel framework to create three address lists 
- Country
- Governorate
- City

Each is dependent on the other:  **Country > Governorate > City**

## Install
Installation is a very simple.
### Using Composer
```bash
composer install moassaad/address-list-lib
```

## Useing

### Data Structure
This is a data come from database or anouter storage.
```json
{
    "country":"1",
    "governorate":"1",
    "city":"56",
    "address":"street 10th of zo-elhega"
}
```

### Basic using
```php
<?php

use Moassaad\Addressia\AddressClient;

$dataget = '{"country":"1","governorate":"1","city":"56","address":"street 10th of zo-elhega"}';

$address = new AddressClient($dataget);

print_r($address->getLineOne());
print_r($address->getLineTwo());
print_r($address->getAllAddress());
```

### Advanced

#### using data get:-
```php
<?php

use Moassaad\Addressia\AddressClient;

$dataget = '{"country":"1","governorate":"1","city":"56","address":"street 10th of zo-elhega"}';

$address = new AddressClient($dataget);

$country = $address->getCountry(); // Country Model.
print_r($country->id());
print_r($country->name_en());
print_r($country->name_ar());
print_r($country->name());

$governorate = $address->getGovernorate(); // Governorate Model.
print_r($governorate->id());
print_r($governorate->name_en());
print_r($governorate->name_ar());
print_r($governorate->name());

$city = $address->getCity(); // City Model.
print_r($city->id());
print_r($city->name_en());
print_r($city->name_ar());
print_r($city->name());
```

#### using data set:-
```php
<?php

use Moassaad\Addressia\AddressClient;

$dataset = [
    "country"=>"1",
    "governorate"=>"1",
    "city"=>"56",
    "address"=>"street 10th of zo-elhega"
];

$address = AddressClient::set($dataget);

print_r($addtess);
```

#### get address list:-
```php
<?php

use Moassaad\Addressia\AddressClient;

$address = new AddressClient();
        
$countries = $address->getAddressList()->getCountries(); // array of Country model.
$country = $countries[1];

print_r($countries);


$governorates = $address->getAddressList()->getGovernorates($country->id()); // array of Governorate model.
$governorate = $governorates[1];

print_r($governorates);


$cities = $address->getAddressList()->getCities($country->id(), $governorate->id()); // array of City model.
$city = $cities[0];

print_r($cities);
```

## Contact Me

- Email: **[mohammadassaadgo@gmail.com](mailto:mohammadassaadgo@gmail.com)**
- LinkedIn: **[@moasaad](https://www.linkedin.com/in/moasaad)**
- GitHub: **[@moassaad](https://github.com/moassaad)**

