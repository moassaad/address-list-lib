# Address List Lib


## Introduction

Address Library is a library used in the Laravel framework to create three address lists 
- Country
- Governorate
- City

Each is dependent on the other:  **Country > Governorate > City**

## Install

Installation is a very simple process, all you have to do is copy the folders to your framework

### _Note_
- Only the contents of file( routes/api.php ) are copied to avoid rewriting on file( api.php )

## Useing

The use is twotrend 

### The first trend is to use the API application

```
/address/country
```
It is used to retrieve all available countries

``` link
/address/country/1
```
It is used to fetch the city of one country with the code

``` link
/address/country/1/governorate
```
It is used to retrieve all governorates within a country

``` link
/address/country/1/governorate/1
```
It is used to retrieve one governorate with the code

``` link
/address/country/1/governorate/1/city
```
It is used to retrieve all cities located within a governorate

``` link
/address/country/1/governorate/1/city/1
```
It is used to retrieve a city specified by the code

### The second trend is at the application programming level

_**AddressCode**_ : It is the class from which the query about addresses begins, and it is of the static class type, so all the functions within it are of the static type.

``` php
$countrys = AddressCode::country();
$countrys = $country->list();
```
It is used to retrieve all available countries

``` php
$country = AddressCode::country(1);
$country = $country->id();
$country = $country->name_ar();
$country = $country->name_en();
$country = $country->name("en");
$country = $country->getData();
```
It is used to fetch the city of one country with the code

``` php
$governorates = AddressCode::country(1)->governorate();
// Or 
$governorates = AddressCode::governorate(1);
```
It is used to retrieve all governorates within a country

``` php
$governorate = AddressCode::country(1)->governorate(1);
// Or 
$governorate = AddressCode::governorate(1,1);

$governorate = $governorate->id();
$governorate = $governorate->name_ar();
$governorate = $governorate->name_en();
$governorate = $governorate->name("en");
$governorate = $governorate->getData();

```
It is used to retrieve one governorate with the code

``` php
$cities = AddressCode::country(1)->governorate(1)->city();
// Or 
$cities = AddressCode::city(1,1);
```
It is used to retrieve all cities located within a governorate

``` php
$city = AddressCode::country(1)->governorate(1)->city(1)
// Or 
$city = AddressCode::city(1,1,1)

$city = $city->id();
$city = $city->name_ar();
$city = $city->name_en();
$city = $city->name("en");

```
It is used to retrieve a city specified by the code


### 

## Skills
- **Problem Solving**
- **Analytical Skills**
- **PHP**
- **Laravel**
- **JSON**
- **Object-Oriented Programming ( OOP )**
- **API**


## Libraries
- 

## Contact Me

- Email: **[mohammadassaadgo@gmail.com](mailto:mohammadassaadgo@gmail.com)**
- LinkedIn: **[@moasaad](https://www.linkedin.com/in/moasaad)**
- GitHub: **[@moassaad](https://github.com/moassaad)**

