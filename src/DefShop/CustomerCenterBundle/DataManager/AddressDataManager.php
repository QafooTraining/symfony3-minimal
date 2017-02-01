<?php

namespace DefShop\CustomerCenterBundle\DataManager;

use DefShop\CustomerCenterBundle\Entity\Address;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class AddressDataManager
{
    private $repository;

    private $entityManager;

    public function __construct(EntityRepository $repository, EntityManager $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function get($addressId)
    {
        $address = $this->repository->find($addressId);
        if (!$address) {
            throw new \OutOfBoundsException("No address with $addressId found.");
        }

        return $address;
    }

    public function store(Address $address)
    {
        $this->entityManager->persist($address);
        $this->entityManager->flush();
    }

    public function remove(Address $address)
    {
        $this->entityManager->remove($address);
        $this->entityManager->flush();
    }
}