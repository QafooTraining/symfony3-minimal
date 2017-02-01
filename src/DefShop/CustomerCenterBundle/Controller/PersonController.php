<?php

namespace DefShop\CustomerCenterBundle\Controller;

use DefShop\CustomerCenterBundle\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    public function indexAction(Request $request)
    {
        $personService = $this->get('CustomerCenter.Domain.PersonService');
        if ($request->getMethod() === 'POST') {
            $person = new Person();
            $person->name = $request->get('name');

            $personService->store($person);
        }

        return [
            'persons' => $personService->getAll(),
        ];
    }
}
