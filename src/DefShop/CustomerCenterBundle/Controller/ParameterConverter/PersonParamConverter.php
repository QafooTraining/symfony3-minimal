<?php

namespace DefShop\CustomerCenterBundle\Controller\ParameterConverter;

use DefShop\CustomerCenterBundle\DataManager\PersonDataManager;
use DefShop\CustomerCenterBundle\Entity\Person;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class PersonParamConverter implements ParamConverterInterface
{
    private $personDataManager;

    public function __construct(PersonDataManager $personDataManager)
    {
        $this->personDataManager = $personDataManager;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $personId = $request->attributes->get($configuration->getName());
        if (!$personId) {
            return false;
        }

        $request->attributes->set($configuration->getName(), $this->personDataManager->get($personId));
        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return Person::class === $configuration->getClass();
    }
}