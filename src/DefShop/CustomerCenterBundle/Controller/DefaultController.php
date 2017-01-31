<?php

namespace DefShop\CustomerCenterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $addressService = $this->get('defshop.customer_center.address_service');

        return [
            'name' => $name,
            'address' => $addressService->getAddressForName($name),
        ];
    }
}
