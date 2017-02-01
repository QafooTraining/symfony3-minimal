<?php

namespace DefShop\CustomerCenterBundle\Entity;

use Kore\DataObject\DataObject;

class Address extends DataObject
{
    public $id;
    public $street;
    public $zip;
    public $city;
    public $country;

    /**
     * @var Person
     */
    public $person;
}