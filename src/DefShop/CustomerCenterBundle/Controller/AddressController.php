<?php

namespace DefShop\CustomerCenterBundle\Controller;

use DefShop\CustomerCenterBundle\Entity\Address;
use DefShop\CustomerCenterBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddressController extends Controller
{
    public function indexAction($personId, Request $request)
    {
        $entityManager = $this->get('doctrine.orm.default_entity_manager');

        $personRepository = $entityManager->getRepository(Person::class);
        $person = $personRepository->find($personId);

        if ($request->getMethod() === 'POST') {
            $address = new Address();
            $address->street = $request->get('street');
            $address->zip = $request->get('zip');
            $address->city = $request->get('city');
            $address->country = $request->get('country');
            $address->person = $person;

            $entityManager->persist($address);
            $entityManager->flush();

            return $this->redirectToRoute('defshop.customer_center.address', ['personId' => $personId]);
        }

        return [
            'person' => $person,
        ];
    }

    public function removeAction($personId, $addressId)
    {
        $entityManager = $this->get('doctrine.orm.default_entity_manager');
        $addressRepository = $entityManager->getRepository(Address::class);
        $address = $addressRepository->find($addressId);
        $entityManager->remove($address);
        $entityManager->flush();

        return $this->redirectToRoute('defshop.customer_center.address', ['personId' => $personId]);
    }
}
