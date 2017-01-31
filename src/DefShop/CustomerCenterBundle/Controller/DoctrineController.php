<?php

namespace DefShop\CustomerCenterBundle\Controller;

use DefShop\CustomerCenterBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DoctrineController extends Controller
{
    public function indexAction(Request $request)
    {
        $entityManager = $this->get('doctrine.orm.default_entity_manager');
        if ($request->getMethod() === 'POST') {
            $address = new Address();
            $address->name = $request->get('name');
            $address->street = $request->get('street');
            $address->zip = $request->get('zip');
            $address->city = $request->get('city');

            $entityManager->persist($address);
            $entityManager->flush();
        }

        $addressRepository = $entityManager->getRepository(Address::class);

        return [
            'addresses' => $addressRepository->findAll(),
        ];
    }

    public function removeAction($addressId)
    {
        $entityManager = $this->get('doctrine.orm.default_entity_manager');
        $addressRepository = $entityManager->getRepository(Address::class);
        $address = $addressRepository->find($addressId);
        $entityManager->remove($address);
        $entityManager->flush();

        return $this->redirectToRoute('defshop.customer_center.doctrine_demo');
    }
}
