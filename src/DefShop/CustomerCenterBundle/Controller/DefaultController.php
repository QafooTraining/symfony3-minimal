<?php

namespace DefShop\CustomerCenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $addressService = $this->get('CustomerCenter.Domain.AddressService');

        return [
            'name' => $name,
            'address' => $addressService->getAddressForName($name),
        ];
    }
}
