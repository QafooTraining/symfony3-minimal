<?php

namespace DefShop\CustomerCenterBundle\DataManager;

use DefShop\CustomerCenterBundle\Entity\Person;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class PersonDataManager
{
    private $repository;

    private $entityManager;

    public function __construct(EntityRepository $repository, EntityManager $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function get($personId)
    {
        $person = $this->repository->find($personId);
        if (!$person) {
            throw new \OutOfBoundsException("No person with $personId found.");
        }

        return $person;
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function store(Person $person)
    {
        $this->entityManager->persist($person);
        $this->entityManager->flush();
    }
}