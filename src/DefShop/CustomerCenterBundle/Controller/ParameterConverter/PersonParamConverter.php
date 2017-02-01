<?php

namespace DefShop\CustomerCenterBundle\Controller\ParameterConverter;

use DefShop\CustomerCenterBundle\Entity\Person;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class PersonParamConverter implements ParamConverterInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $personId = $request->attributes->get($configuration->getName());

        $personRepository = $this->entityManager->getRepository(Person::class);
        $person = $personRepository->find($personId);

        if (!$person) {
            throw new \OutOfBoundsException("Could not find person with id $personId");
        }

        $request->attributes->set($configuration->getName(), $person);
        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        var_dump(__METHOD__);
        return Person::class === $configuration->getClass();
    }
}