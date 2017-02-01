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
        $entityManager = $this->get('doctrine.orm.default_entity_manager');

        if ($request->getMethod() === 'POST') {
            $address = new Address();
            $address->street = $request->get('street');
            $address->zip = $request->get('zip');
            $address->city = $request->get('city');
            $address->country = $request->get('country');
            $address->person = $person;

            $entityManager->persist($address);
            $entityManager->flush();

            return $this->redirectToRoute('CustomerCenter.Address.index', ['person' => $person->id]);
        }

        return [
            'person' => $person,
        ];
    }

    public function removeAction(Person $person, Address $address)
    {
        $entityManager = $this->get('doctrine.orm.default_entity_manager');

        $entityManager->remove($address);
        $entityManager->flush();

        return $this->redirectToRoute('CustomerCenter.Address.index', ['person' => $person->id]);
    }
}
