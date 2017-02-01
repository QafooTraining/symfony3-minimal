<?php

namespace DefShop\CustomerCenterBundle\Controller;

use DefShop\CustomerCenterBundle\Entity\Address;
use DefShop\CustomerCenterBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    public function indexAction(Person $person, Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $address = new Address();
            $address->street = $request->get('street');
            $address->zip = $request->get('zip');
            $address->city = $request->get('city');
            $address->country = $request->get('country');
            $address->person = $person;

            $addressService = $this->get('CustomerCenter.Domain.AddressService');
            $addressService->store($address);

            return $this->redirectToRoute('CustomerCenter.Address.index', ['person' => $person->id]);
        }

        return [
            'person' => $person,
        ];
    }

    public function removeAction(Person $person, Address $address)
    {
        $addressService = $this->get('CustomerCenter.Domain.AddressService');
        $addressService->remove($address);

        return $this->redirectToRoute('CustomerCenter.Address.index', ['person' => $person->id]);
    }
}
