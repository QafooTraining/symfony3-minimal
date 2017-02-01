<?php

namespace DefShop\CustomerCenterBundle\Domain;

use DefShop\CustomerCenterBundle\DataManager\AddressDataManager;
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

    private $dataManager;

    public function __construct(AddressDataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    public function getAddressForName($name) {
        if (!isset($this->addresses[$name])) {
            throw new \OutOfBoundsException("No address for $name available.");
        }

        return new Address($this->addresses[$name]);
    }

    public function store(Address $address)
    {
        return $this->dataManager->store($address);
    }

    public function remove(Address $address)
    {
        return $this->dataManager->remove($address);
    }
}