<?php

namespace DefShop\CustomerCenterBundle\Controller;

use DefShop\CustomerCenterBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    public function indexAction(Request $request)
    {
        $entityManager = $this->get('doctrine.orm.default_entity_manager');
        if ($request->getMethod() === 'POST') {
            $person = new Person();
            $person->name = $request->get('name');

            $entityManager->persist($person);
            $entityManager->flush();
        }

        $personRepository = $entityManager->getRepository(Person::class);

        return [
            'persons' => $personRepository->findAll(),
        ];
    }

    public function removeAction($personId)
    {
        $entityManager = $this->get('doctrine.orm.default_entity_manager');
        $addressRepository = $entityManager->getRepository(Address::class);
        $person = $addressRepository->find($personId);
        $entityManager->remove($person);
        $entityManager->flush();

        return $this->redirectToRoute('defshop.customer_center.person');
    }
}
