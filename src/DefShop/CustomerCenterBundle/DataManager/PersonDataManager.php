<?php

namespace DefShop\CustomerCenterBundle\DataManager;

use DefShop\CustomerCenterBundle\Entity\Address;
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
        $query = $this->entityManager->createQuery(
            'SELECT p, a FROM ' . Person::class . ' p
                LEFT JOIN p.addresses a
            WHERE p.id = :id
            ORDER BY a.zip ASC'
        );
        $query->setParameter('id', $personId);

        return $query->getSingleResult();
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