<?php

namespace DefShop\CustomerCenterBundle\Service;

use DefShop\CustomerCenterBundle\Entity\Address;

class AddressService
{
    private $addresses = [
        'kore' => [
            'street' => 'Büngeler Straße 64',
            'zip' => 46539,
            'city' => 'Dinslaken',
            'country' => 'Germany',
        ],
    ];

    public function getAddressForName($name) {
        if (!isset($this->addresses[$name])) {
            throw new \OutOfBoundsException("No address for $name available.");
        }

        return new Address($this->addresses[$name]);
    }
}