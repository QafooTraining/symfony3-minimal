<?php

namespace DefShop\CustomerCenterBundle\Service;

use Kore\DataObject\DataObject;

class Address extends DataObject
{
    public $street;
    public $zip;
    public $city;
    public $country;
}