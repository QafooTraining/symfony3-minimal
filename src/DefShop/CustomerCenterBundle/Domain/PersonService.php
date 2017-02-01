<?php

namespace DefShop\CustomerCenterBundle\Domain;

use DefShop\CustomerCenterBundle\DataManager\PersonDataManager;
use DefShop\CustomerCenterBundle\Entity\Person;

class PersonService
{
    private $dataManager;

    public function __construct(PersonDataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    public function get($personId)
    {
        return $this->dataManager->get($personId);
    }

    public function getAll()
    {
        return $this->dataManager->getAll();
    }

    public function store(Person $person)
    {
        return $this->dataManager->store($person);
    }
}