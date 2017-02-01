<?php

namespace DefShop\CustomerCenterBundle\Controller\ParameterConverter;

use DefShop\CustomerCenterBundle\DataManager\AddressDataManager;
use DefShop\CustomerCenterBundle\Entity\Address;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class AddressParamConverter implements ParamConverterInterface
{
    private $addressDataManager;

    public function __construct(AddressDataManager $addressDataManager)
    {
        $this->addressDataManager = $addressDataManager;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $addressId = $request->attributes->get($configuration->getName());
        if (!$addressId) {
            return false;
        }

        $request->attributes->set($configuration->getName(), $this->addressDataManager->get($addressId));
        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return Address::class === $configuration->getClass();
    }
}